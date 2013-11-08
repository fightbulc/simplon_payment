<?php

    namespace Simplon\Payment\Provider\Paypal\Vo;

    use Simplon\Payment\Iface\ChargeVoCustomDataInterface;

    class ChargeVoCustomData implements ChargeVoCustomDataInterface
    {
        protected $_urlSuccess;
        protected $_urlCancel;
        protected $_paymentId;

        // ######################################

        /**
         * @param mixed $paymentId
         *
         * @return ChargeVoCustomData
         */
        public function setPaymentId($paymentId)
        {
            $this->_paymentId = $paymentId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPaymentId()
        {
            return (string)$this->_paymentId;
        }

        // ######################################

        /**
         * @param mixed $urlCancel
         *
         * @return ChargeVoCustomData
         */
        public function setUrlCancel($urlCancel)
        {
            $this->_urlCancel = $urlCancel;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getUrlCancel()
        {
            return $this->_urlCancel;
        }

        // ######################################

        /**
         * @param mixed $urlSuccess
         *
         * @return ChargeVoCustomData
         */
        public function setUrlSuccess($urlSuccess)
        {
            $this->_urlSuccess = $urlSuccess;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getUrlSuccess()
        {
            return $this->_urlSuccess;
        }
    }