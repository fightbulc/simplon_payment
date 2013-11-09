<?php

    namespace Simplon\Payment\Provider\Sample;

    use Simplon\Payment\Iface\ChargeResponseVoInterface;
    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Iface\ProviderAuthInterface;
    use Simplon\Payment\Iface\ProviderInterface;
    use Simplon\Payment\Vo\ChargeResponseVo;

    class Sample implements ProviderInterface
    {
        /**
         * @param ProviderAuthInterface $authVo
         */
        public function __construct(ProviderAuthInterface $authVo)
        {
            // handle auth
        }

        /**
         * @param ChargeVoInterface $chargeVo
         *
         * @return ChargeResponseVoInterface|ChargeResponseVo
         */
        public function processCharge(ChargeVoInterface $chargeVo)
        {
            // handle charge

            return new ChargeResponseVo();
        }
    } 