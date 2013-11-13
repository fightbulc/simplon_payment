<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    use Simplon\Helper\VoSetDataFactory;
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
         * @param array $data
         *
         * @return PaypalAuthVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('clientId', function ($val) { $this->setClientId($val); })
                ->setConditionByKey('secret', function ($val) { $this->setSecret($val); })
                ->run();

            return $this;
        }

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
         * @return string
         */
        public function getSecret()
        {
            return (string)$this->_secret;
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
         * @return string
         */
        public function getClientId()
        {
            return (string)$this->_clientId;
        }
    }