<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    class ChargeVo extends \Simplon\Payment\Vo\ChargeVo
    {
        /**
         * @param ChargePayerVo $chargePayerVo
         *
         * @return ChargeVo
         */
        public function setChargePayerVo(ChargePayerVo $chargePayerVo)
        {
            return parent::setChargePayerVo($chargePayerVo);
        }

        // ######################################

        /**
         * @return ChargePayerVo
         */
        public function getChargePayerVo()
        {
            return $this->_chargePayerVo;
        }
    }