<?php

    namespace Simplon\Payment\Provider\Paypal\Vo;

    use Simplon\Payment\Iface\ChargePayerVoCustomDataInterface;

    class ChargePayerVoCustomData implements ChargePayerVoCustomDataInterface
    {
        protected $_method;
        protected $_payerId;

        // ######################################

        /**
         * @param mixed $payerId
         *
         * @return ChargePayerVoCustomData
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
         * @return ChargePayerVoCustomData
         */
        public function setMethod($method)
        {
            $this->_method = $method;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getMethod()
        {
            return (string)$this->_method;
        }
    }