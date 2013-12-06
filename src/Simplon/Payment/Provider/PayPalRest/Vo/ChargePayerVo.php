<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    use Simplon\Payment\Iface\ChargePayerVoInterface;
    use Simplon\Payment\Traits\ChargePayerVoTrait;

    class ChargePayerVo implements ChargePayerVoInterface
    {
        use ChargePayerVoTrait;

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