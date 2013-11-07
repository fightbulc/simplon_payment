<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Payment\Iface\ProviderAuthInterface;

    class StripeAuthVo implements ProviderAuthInterface
    {
        protected $_apiKey;

        // ######################################

        /**
         * @param mixed $apiKey
         *
         * @return StripeAuthVo
         */
        public function setApiKey($apiKey)
        {
            $this->_apiKey = $apiKey;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getApiKey()
        {
            return (string)$this->_apiKey;
        }
    }