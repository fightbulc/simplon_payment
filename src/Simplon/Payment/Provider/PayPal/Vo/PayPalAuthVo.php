<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Payment\Iface\ProviderAuthInterface;

    class PayPalAuthVo implements ProviderAuthInterface
    {
        /** @var String */
        protected $_username;

        /** @var String */
        protected $_password;

        /** @var String */
        protected $_signature;

        /** @var bool */
        protected $_sandboxMode = FALSE;

        // ######################################

        /**
         * @param String $password
         *
         * @return PayPalAuthVo
         */
        public function setPassword($password)
        {
            $this->_password = $password;

            return $this;
        }

        // ######################################

        /**
         * @return String
         */
        public function getPassword()
        {
            return $this->_password;
        }

        // ######################################

        /**
         * @param boolean $sandboxMode
         *
         * @return PayPalAuthVo
         */
        public function setSandboxMode($sandboxMode)
        {
            $this->_sandboxMode = $sandboxMode;

            return $this;
        }

        // ######################################

        /**
         * @return boolean
         */
        public function getSandboxMode()
        {
            return $this->_sandboxMode;
        }

        // ######################################

        /**
         * @param String $signature
         *
         * @return PayPalAuthVo
         */
        public function setSignature($signature)
        {
            $this->_signature = $signature;

            return $this;
        }

        // ######################################

        /**
         * @return String
         */
        public function getSignature()
        {
            return $this->_signature;
        }

        // ######################################

        /**
         * @param String $username
         *
         * @return PayPalAuthVo
         */
        public function setUsername($username)
        {
            $this->_username = $username;

            return $this;
        }

        // ######################################

        /**
         * @return String
         */
        public function getUsername()
        {
            return $this->_username;
        }
    }