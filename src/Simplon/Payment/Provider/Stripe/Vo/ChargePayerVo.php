<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Payment\Iface\ChargePayerVoInterface;
    use Simplon\Payment\Traits\ChargePayerVoTrait;

    class ChargePayerVo implements ChargePayerVoInterface
    {
        use ChargePayerVoTrait;

        protected $_customerId;
        protected $_cardId;
        protected $_cardToken;

        // ######################################

        /**
         * @param mixed $providerId
         *
         * @return ChargePayerVo
         */
        public function setCustomerId($providerId)
        {
            $this->_customerId = $providerId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCustomerId()
        {
            return (string)$this->_customerId;
        }

        // ######################################

        /**
         * @param mixed $providerMeanId
         *
         * @return ChargePayerVo
         */
        public function setCardId($providerMeanId)
        {
            $this->_cardId = $providerMeanId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCardId()
        {
            return (string)$this->_cardId;
        }

        // ######################################

        /**
         * @param mixed $cardToken
         *
         * @return ChargePayerVo
         */
        public function setCardToken($cardToken)
        {
            $this->_cardToken = $cardToken;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCardToken()
        {
            return (string)$this->_cardToken;
        }
    }