<?php

    namespace Simplon\Payment\Provider\Stripe;

    use Simplon\Payment\ChargeStateConstants;
    use Simplon\Payment\Provider\Stripe\Vo\ChargePayerVo;
    use Simplon\Payment\Provider\Stripe\Vo\ChargeResponseVo;
    use Simplon\Payment\Provider\Stripe\Vo\ChargeVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeAuthVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCardVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeChargeVo;
    use Simplon\Payment\Provider\Stripe\Vo\StripeCustomerVo;

    class Stripe
    {
        protected $_authVo;
        protected $_stripeApiInstance;

        // ######################################

        /**
         * @param StripeAuthVo $authVo
         */
        public function __construct(StripeAuthVo $authVo)
        {
            $this->_authVo = $authVo;
        }

        // ######################################

        /**
         * @return StripeAuthVo
         */
        protected function _getAuthVo()
        {
            return $this->_authVo;
        }

        // ######################################

        /**
         * @return StripeApi
         */
        protected function _getStripeApiInstance()
        {
            if (!$this->_stripeApiInstance)
            {
                $this->_stripeApiInstance = new StripeApi($this->_getAuthVo());
            }

            return $this->_stripeApiInstance;
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return ChargePayerVo
         */
        protected function _getChargePayerVo(ChargeVo $chargeVo)
        {
            return $chargeVo->getChargePayerVo();
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return Vo\ChargeProductVo[]
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
            if (!$chargePayerVo->getCustomerId())
            {
                $stripeCustomerVo = (new StripeCustomerVo())->setEmail($chargePayerVo->getEmail());

                return $this->_getStripeApiInstance()
                    ->createCustomer($stripeCustomerVo);
            }

            return $this->_getStripeApiInstance()
                ->getCustomer($chargePayerVo->getCustomerId());
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
            if (!$chargePayerVo->getCardId())
            {
                return $this->_getStripeApiInstance()
                    ->createCard($stripeCustomerVo, $chargePayerVo->getCardToken());
            }

            return $this->_getStripeApiInstance()
                ->getCard($stripeCustomerVo, $chargePayerVo->getCardId());
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return ChargeResponseVo
         */
        public function charge(ChargeVo $chargeVo)
        {
            // get chargerPayerVo
            $chargePayerVo = $this->_getChargePayerVo($chargeVo);

            // retrieve/create customer
            $stripeCustomerVo = $this->_retrieveCreateCustomer($chargePayerVo);

            // retrieve/create card
            $stripeCardVo = $this->_retrieveCreateCard($stripeCustomerVo, $chargePayerVo);

            // get total amount
            $totalAmountCents = $chargeVo->getTotalAmountCents();

            // ----------------------------------

            // create stripeChargeVo
            $stripeChargeVo = (new StripeChargeVo())
                ->setStripeCardVo($stripeCardVo)
                ->setAmountCents($totalAmountCents)
                ->setCurrency($chargeVo->getCurrency());

            // charge on stripe
            $stripeChargeVo = $this->_getStripeApiInstance()
                ->createCharge($stripeCustomerVo, $stripeChargeVo);

            // ----------------------------------

            // add stripe payer data
            $chargePayerVo
                ->setCustomerId($stripeCustomerVo->getId())
                ->setCardId($stripeCardVo->getId())
                ->setCardToken(NULL);

            // ----------------------------------

            // update payer data
            $chargeVo->setChargePayerVo($chargePayerVo);

            // determine state
            $chargeState = $stripeChargeVo->getPaid() === TRUE ? ChargeStateConstants::COMPLETED : ChargeStateConstants::FAILED;

            // create chargeResponseVo
            $chargeResponseVo = (new ChargeResponseVo())
                ->setChargeVo($chargeVo)
                ->setTransactionId($stripeChargeVo->getId())
                ->setStatus($chargeState);

            return $chargeResponseVo;
        }
    }