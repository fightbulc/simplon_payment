<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Helper\VoSetDataFactory;
    use Simplon\Payment\Iface\ProviderAuthInterface;

    class StripeAuthVo implements ProviderAuthInterface
    {
        protected $_publicKey;
        protected $_privateKey;

        // ######################################

        /**
         * @param array $data
         *
         * @return StripeAuthVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('publicKey', function ($val) { $this->setPublicKey($val); })
                ->setConditionByKey('privateKey', function ($val) { $this->setPrivateKey($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $publicKey
         *
         * @return StripeAuthVo
         */
        public function setPublicKey($publicKey)
        {
            $this->_publicKey = $publicKey;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPublicKey()
        {
            return (string)$this->_publicKey;
        }

        // ######################################

        /**
         * @param mixed $apiKey
         *
         * @return StripeAuthVo
         */
        public function setPrivateKey($apiKey)
        {
            $this->_privateKey = $apiKey;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPrivateKey()
        {
            return (string)$this->_privateKey;
        }
    }