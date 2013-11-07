<?php

    namespace Simplon\Payment;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Iface\ProviderInterface;

    class Payment
    {
        protected $_provider;
        protected $_chargeVo;

        // ######################################

        /**
         * @param ProviderInterface $provider
         * @param ChargeVoInterface $chargeVo
         */
        public function __construct(ProviderInterface $provider, ChargeVoInterface $chargeVo)
        {
            $this->_provider = $provider;
            $this->_chargeVo = $chargeVo;

        }

        // ######################################

        /**
         * @return Iface\ChargeResponseVoInterface
         */
        public function process()
        {
            $chargeResponseVo = $this->_provider->processCharge($this->_chargeVo);

            return $chargeResponseVo;
        }
    }