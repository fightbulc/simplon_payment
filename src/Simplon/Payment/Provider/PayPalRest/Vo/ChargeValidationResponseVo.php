<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    class ChargeValidationResponseVo
    {
        protected $_transactionId;
        protected $_status;

        // ######################################

        /**
         * @param mixed $status
         *
         * @return ChargeValidationResponseVo
         */
        public function setStatus($status)
        {
            $this->_status = $status;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getStatus()
        {
            return (string)$this->_status;
        }

        // ######################################

        /**
         * @param mixed $transactionId
         *
         * @return ChargeValidationResponseVo
         */
        public function setTransactionId($transactionId)
        {
            $this->_transactionId = $transactionId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getTransactionId()
        {
            return (string)$this->_transactionId;
        }
    }