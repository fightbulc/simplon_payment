<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    use Simplon\Payment\Iface\ChargePayerVoCustomDataInterface;

    class ChargePayerCustomDataVo implements ChargePayerVoCustomDataInterface
    {
        protected $_payMethod;
        protected $_payerId;

        // ######################################

        /**
         * @param mixed $payerId
         *
         * @return ChargePayerCustomDataVo
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

        // ######################################

        /**
         * @param mixed $method
         *
         * @return ChargePayerCustomDataVo
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