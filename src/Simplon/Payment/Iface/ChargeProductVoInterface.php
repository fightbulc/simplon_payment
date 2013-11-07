<?php

    namespace Simplon\Payment\Iface;

    interface ChargeProductVoInterface
    {
        public function getReferenceId();

        public function getName();

        public function getPriceCents();

        public function getPriceVat();

        public function getPriceIncludesVat();

        public function getPriceVatCents();

        public function getSurchargeCents();

        public function getSurchargeVat();

        public function getSurchargeIncludesVat();

        public function getSurchargeVatCents();
    }