<?php

    namespace Simplon\Payment;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Iface\ProviderInterface;

    class Payment
    {
        /** @var \Simplon\Payment\Iface\ProviderInterface */
        protected $_provider;

        // ######################################

        /**
         * @param ProviderInterface $provider
         */
        public function __construct(ProviderInterface $provider)
        {
            $this->_provider = $provider;
        }

        // ######################################

        /**
         * @param ChargeVoInterface $chargeVo
         *
         * @return Iface\ChargeResponseVoInterface
         */
        public function process(ChargeVoInterface $chargeVo)
        {
            $providerChargeResponseVo = $this->_provider->processCharge($chargeVo);

            return $providerChargeResponseVo;
        }
    }