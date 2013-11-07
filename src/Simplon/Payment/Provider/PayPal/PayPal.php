<?php

    namespace Simplon\Payment\Provider\PayPal;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Iface\ProviderAuthInterface;
    use Simplon\Payment\Iface\ProviderInterface;
    use Simplon\Payment\Provider\Stripe\Vo\PayPalAuthVo;
    use Simplon\Payment\Vo\ChargeVo;

    class PayPal implements ProviderInterface
    {
        /** @var  PayPalAuthVo */
        protected $_authVo;

        /** @var  ChargeVo */
        protected $_chargeVo;

        // ######################################

        /**
         * @param ProviderAuthInterface $authVo
         */
        public function __construct(ProviderAuthInterface $authVo)
        {
            $this->_authVo = $authVo;
        }

        // ######################################

        /**
         * @return PayPalAuthVo
         */
        protected function _getAuthVo()
        {
            return $this->_authVo;
        }

        // ######################################

        /**
         * @param ChargeVoInterface $chargeVo
         *
         * @return PayPal
         */
        protected function _setChargeVo(ChargeVoInterface $chargeVo)
        {
            $this->_chargeVo = $chargeVo;

            return $this;
        }

        // ######################################

        /**
         * @return ChargeVo
         */
        protected function _getChargeVo()
        {
            return $this->_chargeVo;
        }

        // ######################################

        /**
         * @param ChargeVoInterface $chargeVo
         *
         * @return \Simplon\Payment\Iface\ChargeResponseVoInterface|void
         */
        public function processCharge(ChargeVoInterface $chargeVo)
        {
            echo "\n\nCHARGING NOW...\n\n\n";
        }
    }