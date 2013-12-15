<?php

    namespace Simplon\Payment\Provider\IcepayIdeal\Vo;

    use Simplon\Payment\Iface\ChargeResponseVoInterface;
    use Simplon\Payment\Traits\ChargeResponseVoTrait;

    class ChargeResponseVo implements ChargeResponseVoInterface
    {
        use ChargeResponseVoTrait;

        protected $_urlApproval;
        protected $_paymentId;
        protected $_providerTransactionId;

        // ######################################

        /**
         * @param mixed $paymentId
         *
         * @return ChargeResponseVo
         */
        public function setPaymentId($paymentId)
        {
            $this->_paymentId = $paymentId;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getPaymentId()
        {
            return (int)$this->_paymentId;
        }

        // ######################################

        /**
         * @param mixed $providerTransactionId
         *
         * @return ChargeResponseVo
         */
        public function setProviderTransactionId($providerTransactionId)
        {
            $this->_providerTransactionId = $providerTransactionId;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getProviderTransactionId()
        {
            return (int)$this->_providerTransactionId;
        }

        // ######################################

        /**
         * @param mixed $urlApproval
         *
         * @return ChargeResponseVo
         */
        public function setUrlApproval($urlApproval)
        {
            $this->_urlApproval = $urlApproval;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlApproval()
        {
            return (string)$this->_urlApproval;
        }

        // ######################################

        /**
         * @return ChargeVo
         */
        public function getChargeVo()
        {
            return $this->_chargeVo;
        }
    } 