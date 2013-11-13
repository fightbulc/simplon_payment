<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    class ChargeValidationVo
    {
        protected $_paymentId;
        protected $_currency;
        protected $_totalAmountCents;

        // ######################################

        /**
         * @param mixed $currency
         *
         * @return ChargeValidationVo
         */
        public function setCurrency($currency)
        {
            $this->_currency = $currency;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCurrency()
        {
            return (string)$this->_currency;
        }

        // ######################################

        /**
         * @param mixed $totalAmountCents
         *
         * @return ChargeValidationVo
         */
        public function setTotalAmountCents($totalAmountCents)
        {
            $this->_totalAmountCents = $totalAmountCents;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getTotalAmountCents()
        {
            return (string)$this->_totalAmountCents;
        }

        // ######################################

        /**
         * @param mixed $urlSuccess
         *
         * @return ChargeValidationVo
         */
        public function setPaymentId($urlSuccess)
        {
            $this->_paymentId = $urlSuccess;

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
    }