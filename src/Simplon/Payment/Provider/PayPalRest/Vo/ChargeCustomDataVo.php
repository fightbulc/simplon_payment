<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    use Simplon\Payment\Iface\ChargeCustomDataVoInterface;

    class ChargeCustomDataVo implements ChargeCustomDataVoInterface
    {
        protected $_urlSuccess;
        protected $_urlCancel;
        protected $_urlApproval;
        protected $_urlExecute;
        protected $_urlSelf;
        protected $_paymentId;

        // ######################################

        /**
         * @param mixed $urlApproval
         *
         * @return ChargeCustomDataVo
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
         * @param mixed $urlExecute
         *
         * @return ChargeCustomDataVo
         */
        public function setUrlExecute($urlExecute)
        {
            $this->_urlExecute = $urlExecute;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlExecute()
        {
            return (string)$this->_urlExecute;
        }

        // ######################################

        /**
         * @param mixed $urlSelf
         *
         * @return ChargeCustomDataVo
         */
        public function setUrlSelf($urlSelf)
        {
            $this->_urlSelf = $urlSelf;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlSelf()
        {
            return (string)$this->_urlSelf;
        }

        // ######################################

        /**
         * @param mixed $paymentId
         *
         * @return ChargeCustomDataVo
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
         * @return ChargeCustomDataVo
         */
        public function setUrlCancel($urlCancel)
        {
            $this->_urlCancel = $urlCancel;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlCancel()
        {
            return (string)$this->_urlCancel;
        }

        // ######################################

        /**
         * @param mixed $urlSuccess
         *
         * @return ChargeCustomDataVo
         */
        public function setUrlSuccess($urlSuccess)
        {
            $this->_urlSuccess = $urlSuccess;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlSuccess()
        {
            return (string)$this->_urlSuccess;
        }
    }