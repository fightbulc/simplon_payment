<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Traits\ChargeVoTrait;

    class ChargeVo implements ChargeVoInterface
    {
        use ChargeVoTrait;

        // ######################################

        /**
         * @param ChargePayerVo $chargePayerVo
         *
         * @return ChargeVo
         */
        public function setChargePayerVo(ChargePayerVo $chargePayerVo)
        {
            $this->_chargePayerVo = $chargePayerVo;

            return $this;
        }

        // ######################################

        /**
         * @return ChargePayerVo
         */
        public function getChargePayerVo()
        {
            return $this->_chargePayerVo;
        }

        // ######################################

        /**
         * @return ChargeProductVo[]
         */
        public function getChargeProductVoMany()
        {
            return $this->_chargeProductVoMany;
        }
    }