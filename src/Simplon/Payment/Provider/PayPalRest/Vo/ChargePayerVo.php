<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    class ChargePayerVo extends \Simplon\Payment\Vo\ChargePayerVo
    {
        protected $_payMethod;

        // ######################################

        /**
         * @param mixed $method
         *
         * @return ChargePayerVo
         */
        public function setPayMethod($method)
        {
            $this->_payMethod = $method;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPayMethod()
        {
            return (string)$this->_payMethod;
        }
    }