<?php

    namespace Simplon\Payment\Provider\Stripe;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Iface\ProviderAuthInterface;
    use Simplon\Payment\Iface\ProviderInterface;
    use Simplon\Payment\Provider\Stripe\Vo\StripeAuthVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCardVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeChargeVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCustomerCardsListVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCustomersListVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCustomerVo;
    use Simplon\Payment\Vo\ChargePayerVo;
    use Simplon\Payment\Vo\ChargeProductVo;
    use Simplon\Payment\Vo\ChargeVo;

    class Stripe implements ProviderInterface
    {
        /**
         * @param ProviderAuthInterface $authVo
         */
        public function __construct(ProviderAuthInterface $authVo)
        {
            /** @var $authVo StripeAuthVo */

            StripeApiRequests::setApiKey($authVo->getApiKey());
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return \Simplon\Payment\Vo\ChargePayerVo
         */
        protected function _getChargePayerVo(ChargeVo $chargeVo)
        {
            return $chargeVo->getChargePayerVo();
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return \Simplon\Payment\Vo\ChargeProductVo[]
         */
        protected function _getChargeProductVoMany(ChargeVo $chargeVo)
        {
            return $chargeVo->getChargeProductVoMany();
        }

        // ######################################

        /**
         * @param ChargePayerVo $chargePayerVo
         *
         * @return bool|StripeCustomerVo
         */
        protected function _retrieveCreateCustomer(ChargePayerVo $chargePayerVo)
        {
            if ($chargePayerVo->isNewPayer() === TRUE)
            {
                $stripeCustomerVo = (new StripeCustomerVo())->setEmail($chargePayerVo->getEmail());

                return $this->createCustomer($stripeCustomerVo);
            }

            return $this->getCustomer($chargePayerVo->getProviderId());
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         * @param ChargePayerVo $chargePayerVo
         *
         * @return bool|StripeCardVo
         */
        protected function _retrieveCreateCard(StripeCustomerVo $stripeCustomerVo, ChargePayerVo $chargePayerVo)
        {
            if ($chargePayerVo->isNewMean() === TRUE)
            {
                return $this->createCard($stripeCustomerVo, $chargePayerVo->getProviderMeanId());
            }

            return $this->getCard($chargePayerVo->getProviderId(), $chargePayerVo->getProviderMeanId());
        }

        // ######################################

        /**
         * @param ChargeProductVo[] $chargeProductVoMany
         *
         * @return int
         */
        protected function _calculateTotalAmountCents(array $chargeProductVoMany)
        {
            $totalAmountCents = 0;

            foreach ($chargeProductVoMany as $chargeProductVo)
            {
                $totalAmountCents += $chargeProductVo->getTotalAmountCents();
            }

            return $totalAmountCents;
        }

        // ######################################

        /**
         * @param ChargeVoInterface $chargeVo
         *
         * @return \Simplon\Payment\Iface\ChargeResponseVoInterface|void
         */
        public function processCharge(ChargeVoInterface $chargeVo)
        {
            // get chargerPayerVo
            $chargePayerVo = $this->_getChargePayerVo($chargeVo);

            // retrieve/create customer
            $stripeCustomerVo = $this->_retrieveCreateCustomer($chargePayerVo);

            // retrieve/create card
            $stripeCardVo = $this->_retrieveCreateCard($stripeCustomerVo, $chargePayerVo);

            // calculate total amount
            $totalAmountCents = $this->_calculateTotalAmountCents($chargeVo->getChargeProductVoMany());

            // ----------------------------------

            // create stripeChargeVo
            $stripeChargeVo = (new StripeChargeVo())
                ->setStripeCardVo($stripeCardVo)
                ->setAmountCents($totalAmountCents)
                ->setCurrency($chargeVo->getCurrency());

            return $this->createCharge($stripeCustomerVo, $stripeChargeVo);
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         *
         * @return bool|StripeCustomerVo
         */
        public function createCustomer(StripeCustomerVo $stripeCustomerVo)
        {
            // call api
            $response = StripeApiRequests::create(
                StripeApiConstants::PATH_CUSTOMER_CREATE,
                $stripeCustomerVo->getData()
            );

            if ($response !== FALSE)
            {
                $stripeCustomerVo->setData($response);

                return $stripeCustomerVo;
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         *
         * @return bool|StripeCustomerVo
         */
        public function updateCustomer(StripeCustomerVo $stripeCustomerVo)
        {
            // call api
            $response = StripeApiRequests::update(
                StripeApiConstants::PATH_CUSTOMER_UPDATE,
                [
                    'customerId' => $stripeCustomerVo->getId(),
                ],
                $stripeCustomerVo->getData()
            );

            if ($response !== FALSE)
            {
                $stripeCustomerVo->setData($response);

                return $stripeCustomerVo;
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         *
         * @return bool|StripeCustomerVo
         */
        public function deleteCustomer(StripeCustomerVo $stripeCustomerVo)
        {
            $response = StripeApiRequests::delete(
                StripeApiConstants::PATH_CUSTOMER_DELETE,
                [
                    'customerId' => $stripeCustomerVo->getId(),
                ]
            );

            if ($response)
            {
                return (new StripeCustomerVo())->setData($response);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param $customerId
         *
         * @return bool|StripeCustomerVo
         */
        public function getCustomer($customerId)
        {
            $response = StripeApiRequests::retrieve(
                StripeApiConstants::PATH_CUSTOMER_RETRIEVE,
                [
                    'customerId' => $customerId,
                ]
            );

            if ($response)
            {
                return (new StripeCustomerVo())->setData($response);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|StripeCustomersListVo
         */
        public function getAllCustomers()
        {
            $response = StripeApiRequests::retrieve(StripeApiConstants::PATH_CUSTOMER_RETRIEVE_ALL);

            if ($response)
            {
                return (new StripeCustomersListVo())->setData($response);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param $customerId
         *
         * @return bool|Vo\StripeCardVo[]
         */
        public function getStripeCardVoMany($customerId)
        {
            $stripeCustomerVo = $this->getCustomer($customerId);

            if ($stripeCustomerVo !== FALSE)
            {
                return $stripeCustomerVo->getStripeCardVoMany();
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         * @param $tokenId
         *
         * @return bool|StripeCardVo
         */
        public function createCard(StripeCustomerVo $stripeCustomerVo, $tokenId)
        {
            $response = StripeApiRequests::create(
                StripeApiConstants::PATH_CARDS_CREATE,
                [
                    'customerId' => $stripeCustomerVo->getId(),
                ],
                [
                    'card' => $tokenId,
                ]
            );

            if ($response)
            {
                return (new StripeCardVo())->setData($response);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         * @param StripeCardVo $stripeCardVo
         *
         * @return bool|StripeCardVo
         */
        public function deleteCard(StripeCustomerVo $stripeCustomerVo, StripeCardVo $stripeCardVo)
        {
            $response = StripeApiRequests::retrieve(
                StripeApiConstants::PATH_CARDS_RETRIEVE,
                [
                    'customerId' => $stripeCustomerVo->getId(),
                    'cardId'     => $stripeCardVo->getId(),
                ]
            );

            if ($response)
            {
                return (new StripeCardVo())->setData($response);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         * @param $cardId
         *
         * @return bool|StripeCardVo
         */
        public function getCard(StripeCustomerVo $stripeCustomerVo, $cardId)
        {
            $response = StripeApiRequests::retrieve(
                StripeApiConstants::PATH_CARDS_RETRIEVE,
                [
                    'customerId' => $stripeCustomerVo->getId(),
                    'cardId'     => $cardId,
                ]
            );

            if ($response)
            {
                return (new StripeCardVo())->setData($response);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         *
         * @return bool|StripeCustomerCardsListVo
         */
        public function getAllCards(StripeCustomerVo $stripeCustomerVo)
        {
            $response = StripeApiRequests::retrieve(
                StripeApiConstants::PATH_CARDS_RETRIEVE_ALL,
                [
                    'customerId' => $stripeCustomerVo->getId(),
                ]
            );

            if ($response)
            {
                return (new StripeCustomerCardsListVo())->setData($response);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param StripeCustomerVo $stripeCustomerVo
         * @param StripeChargeVo $stripeChargeVo
         *
         * @return bool|StripeChargeVo
         */
        public function createCharge(StripeCustomerVo $stripeCustomerVo, StripeChargeVo $stripeChargeVo)
        {
            $stripeCardVo = $stripeChargeVo->getStripeCardVo();

            $data = [
                'customer' => $stripeCustomerVo->getId(),
                'card'     => $stripeCardVo->getId(),
                'amount'   => $stripeChargeVo->getAmountCents(),
                'currency' => $stripeChargeVo->getCurrency(),
            ];

            $response = StripeApiRequests::create(
                StripeApiConstants::PATH_CHARGES_CREATE,
                $data
            );

            if ($response)
            {
                $stripeChargeVo->setData($response);

                return $stripeChargeVo;
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param $chargeId
         *
         * @return bool|StripeChargeVo
         */
        public function getCharge($chargeId)
        {
            $response = StripeApiRequests::retrieve(
                StripeApiConstants::PATH_CHARGES_RETRIEVE,
                [
                    'chargeId' => $chargeId,
                ]
            );

            if ($response)
            {
                return (new StripeChargeVo())->setData($response);
            }

            return FALSE;
        }
    }