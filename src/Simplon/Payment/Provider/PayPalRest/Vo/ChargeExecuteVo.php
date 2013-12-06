<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    class ChargeExecuteVo
    {
        protected $_paymentId;
        protected $_payerId;

        // ######################################

        /**
         * @param mixed $paymentId
         *
         * @return ChargeVo
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
         * @param mixed $payerId
         *
         * @return ChargePayerVo
         */
        public function setPayerId($payerId)
        {
            $this->_payerId = $payerId;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getPayerId()
        {
            return $this->_payerId;
        }
    }