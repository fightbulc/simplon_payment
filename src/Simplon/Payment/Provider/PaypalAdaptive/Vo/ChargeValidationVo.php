<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive\Vo;

    class ChargeValidationVo
    {
        protected $_payKey;
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
        public function setPayKey($urlSuccess)
        {
            $this->_payKey = $urlSuccess;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPayKey()
        {
            return (string)$this->_payKey;
        }
    }