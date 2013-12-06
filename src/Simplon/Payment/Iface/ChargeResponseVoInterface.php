<?php

    namespace Simplon\Payment\Iface;

    interface ChargeResponseVoInterface
    {
        public function getChargeVo();

        public function getTransactionId();

        public function getStatus();
    }