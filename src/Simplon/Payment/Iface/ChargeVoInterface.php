<?php

    namespace Simplon\Payment\Iface;

    interface ChargeVoInterface
    {
        public function getReferenceId();

        public function getDescription();

        public function getCurrency();

        public function getChargePayerVo();

        public function getChargeProductVoMany();
    }