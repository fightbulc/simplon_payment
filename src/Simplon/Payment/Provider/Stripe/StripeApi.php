<?php

    namespace Simplon\Payment\Provider\Stripe;

    use Simplon\Payment\Provider\Stripe\Vo\StripeCardVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeChargeVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCustomerCardsListVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCustomersListVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCustomerVo;

    class StripeApi
    {
        /**
         * @param $privateApiKey
         */
        public function __construct($privateApiKey)
        {
            StripeApiRequests::setApiKey($privateApiKey);
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
                [],
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
                [],
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