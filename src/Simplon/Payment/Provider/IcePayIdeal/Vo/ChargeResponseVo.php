<?php

    namespace Simplon\Payment\Provider\IcePayIdeal\Vo;

    use Simplon\Payment\Iface\ChargeResponseVoInterface;
    use Simplon\Payment\Traits\ChargeResponseVoTrait;

    class ChargeResponseVo implements ChargeResponseVoInterface
    {
        use ChargeResponseVoTrait;

        // ######################################

        /**
         * @return ChargeVo
         */
        public function getChargeVo()
        {
            return $this->_chargeVo;
        }
    } 