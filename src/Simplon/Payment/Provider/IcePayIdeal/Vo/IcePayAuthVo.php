<?php

    namespace Simplon\Payment\Provider\IcepayIdeal\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class IcepayAuthVo
    {
        protected $_merchantId;
        protected $_secretCode;
        protected $_callbackKey;

        // ######################################

        /**
         * @param array $data
         *
         * @return IcepayAuthVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('merchantId', function ($val) { $this->setMerchantId($val); })
                ->setConditionByKey('secretCode', function ($val) { $this->setSecretCode($val); })
                ->setConditionByKey('callbackKey', function ($val) { $this->setCallbackKey($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $callbackKey
         *
         * @return IcepayAuthVo
         */
        public function setCallbackKey($callbackKey)
        {
            $this->_callbackKey = $callbackKey;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCallbackKey()
        {
            return (string)$this->_callbackKey;
        }

        // ######################################

        /**
         * @param mixed $merchantId
         *
         * @return IcepayAuthVo
         */
        public function setMerchantId($merchantId)
        {
            $this->_merchantId = $merchantId;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getMerchantId()
        {
            return (int)$this->_merchantId;
        }

        // ######################################

        /**
         * @param mixed $secretCode
         *
         * @return IcepayAuthVo
         */
        public function setSecretCode($secretCode)
        {
            $this->_secretCode = $secretCode;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getSecretCode()
        {
            return (string)$this->_secretCode;
        }
    }