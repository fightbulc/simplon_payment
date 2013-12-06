<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Payment\Iface\ChargeProductVoInterface;
    use Simplon\Payment\Traits\ChargeProductVoTrait;

    class ChargeProductVo implements ChargeProductVoInterface
    {
        use ChargeProductVoTrait;
    } 