<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive\Vo;

    use Simplon\Payment\Iface\ChargeCustomDataVoInterface;

    class ChargeCustomDataVo implements ChargeCustomDataVoInterface
    {
        protected $_payKey;

        // ######################################

        /**
         * @param mixed $urlSuccess
         *
         * @return ChargeCustomDataVo
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