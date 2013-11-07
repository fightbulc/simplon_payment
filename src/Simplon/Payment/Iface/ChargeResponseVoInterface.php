<?php

    namespace Simplon\Payment\Iface;

    interface ChargeResponseVoInterface extends ChargeVoInterface
    {
        public function getTransactionId();

        public function getResponse();

        public function getStatus();
    }