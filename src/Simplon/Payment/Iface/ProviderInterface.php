<?php

    namespace Simplon\Payment\Iface;

    interface ProviderInterface
    {
        /**
         * @param ProviderAuthInterface $authVo
         */
        public function __construct(ProviderAuthInterface $authVo);

        /**
         * @param ChargeVoInterface $chargeVo
         *
         * @return ChargeResponseVoInterface
         */
        public function processCharge(ChargeVoInterface $chargeVo);
    } 