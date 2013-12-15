<?php

    namespace Simplon\Payment\Provider\IcepayIdeal\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class IcepayAuthVo
    {
        protected $_merchantId;
        protected $_secretCode;

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
                ->setConditionByKey('secret', function ($val) { $this->setSecretCode($val); })
                ->run();

            return $this;
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