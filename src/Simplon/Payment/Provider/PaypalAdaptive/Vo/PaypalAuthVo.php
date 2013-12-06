<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class PaypalAuthVo
    {
        /** @var String */
        protected $_username;

        /** @var String */
        protected $_password;

        /** @var String */
        protected $_signature;

        /** @var String */
        protected $_appId;

        /** @var String */
        protected $_email;

        /** @var bool */
        protected $_sandbox = FALSE;

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalAuthVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('username', function ($val) { $this->setUsername($val); })
                ->setConditionByKey('password', function ($val) { $this->setPassword($val); })
                ->setConditionByKey('signature', function ($val) { $this->setSignature($val); })
                ->setConditionByKey('email', function ($val) { $this->setEmail($val); })
                ->setConditionByKey('appId', function ($val) { $this->setAppId($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param String $email
         *
         * @return PaypalAuthVo
         */
        public function setEmail($email)
        {
            $this->_email = $email;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getEmail()
        {
            return (string)$this->_email;
        }

        // ######################################

        /**
         * @param String $appId
         *
         * @return PaypalAuthVo
         */
        public function setAppId($appId)
        {
            $this->_appId = $appId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getAppId()
        {
            return (string)$this->_appId;
        }

        // ######################################

        /**
         * @param String $signature
         *
         * @return PaypalAuthVo
         */
        public function setSignature($signature)
        {
            $this->_signature = $signature;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getSignature()
        {
            return (string)$this->_signature;
        }

        // ######################################

        /**
         * @param String $password
         *
         * @return PaypalAuthVo
         */
        public function setPassword($password)
        {
            $this->_password = $password;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPassword()
        {
            return (string)$this->_password;
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
        public function setUsername($username)
        {
            $this->_username = $username;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUsername()
        {
            return (string)$this->_username;
        }
    }