<?php

    namespace Simplon\Payment\Provider\Paypal\Vo;

    use Simplon\Payment\Iface\ProviderAuthInterface;

    class PaypalAuthVo implements ProviderAuthInterface
    {
        /** @var String */
        protected $_clientId;

        /** @var String */
        protected $_secret;

        /** @var bool */
        protected $_sandbox = FALSE;

        // ######################################

        /**
         * @param String $password
         *
         * @return PaypalAuthVo
         */
        public function setSecret($password)
        {
            $this->_secret = $password;

            return $this;
        }

        // ######################################

        /**
         * @return String
         */
        public function getSecret()
        {
            return $this->_secret;
        }

        // ######################################

        /**
         * @param boolean $sandboxMode
         *
         * @return PaypalAuthVo
         */
        public function setSandbox($sandboxMode)
        {
            $this->_sandbox = $sandboxMode;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getSandbox()
        {
            return $this->_sandbox !== FALSE ? TRUE : FALSE;
        }

        // ######################################

        /**
         * @param String $username
         *
         * @return PaypalAuthVo
         */
        public function setClientId($username)
        {
            $this->_clientId = $username;

            return $this;
        }

        // ######################################

        /**
         * @return String
         */
        public function getClientId()
        {
            return $this->_clientId;
        }
    }