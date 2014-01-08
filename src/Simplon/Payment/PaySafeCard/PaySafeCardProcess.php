<?php

    namespace Simplon\Payment\PaySafeCard;

    use Simplon\Payment\PaySafeCard\Lib\SOPGClassicMerchantClient;
    use Simplon\Payment\PaySafeCard\Vo\ProcessPaySafeCardVo;

    class PaySafeCardProcess extends PaySafeCardBase
    {
        public function executeDebit(array $data)
        {
            $processPaySafeCardVo = new ProcessPaySafeCardVo($data);

            return (new SOPGClassicMerchantClient($processPaySafeCardVo->getEndPoint()))->executeDebit(
                $processPaySafeCardVo->getUsername(),
                $processPaySafeCardVo->getPassword(),
                $processPaySafeCardVo->getMtid(),
                $processPaySafeCardVo->getSubId(),
                $processPaySafeCardVo->getAmount(),
                $processPaySafeCardVo->getCurrency(),
                $processPaySafeCardVo->getClose(),
                NULL);
        }
    }