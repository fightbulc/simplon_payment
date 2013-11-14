<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Payment\Iface\ChargePayerVoCustomDataInterface;

    class ChargePayerCustomDataVo implements ChargePayerVoCustomDataInterface
    {
        protected $_customerId;
        protected $_cardId;
        protected $_cardToken;

        // ######################################

        /**
         * @param mixed $providerId
         *
         * @return ChargePayerCustomDataVo
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
         * @return ChargePayerCustomDataVo
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
         * @return ChargePayerCustomDataVo
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