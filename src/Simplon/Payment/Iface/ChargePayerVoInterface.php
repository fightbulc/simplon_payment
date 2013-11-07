<?php

    namespace Simplon\Payment\Iface;

    interface ChargePayerVoInterface
    {
        public function isNewPayer();

        public function getProviderId();

        public function isNewMean();

        public function getProviderMeanId();

        public function getName();

        public function getEmail();
    } 