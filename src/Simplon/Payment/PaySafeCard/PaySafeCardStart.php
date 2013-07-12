<?php

    namespace Simplon\Payment\PaySafeCard;

    use Simplon\Payment\PaySafeCard\Lib\SOPGClassicMerchantClient;
    use Simplon\Payment\PaySafeCard\Vo\CheckoutPaySafeCardVo;

    class PaySafeCardStart extends PaySafeCardBase
    {
        public function generateMtid()
        {
            $time = gettimeofday();
            $mtid = $time['sec'];
            $mtid .= $time['usec'];

            return $mtid;
        }

        #########################################

        public function createDisposition(array $data)
        {

            $checkoutDataVo = new CheckoutPaySafeCardVo($data);

            $response = (new SOPGClassicMerchantClient($checkoutDataVo->getEndPoint()))->createDisposition(
                $checkoutDataVo->getUsername(),
                $checkoutDataVo->getPassword(),
                $checkoutDataVo->getMtid(),
                $checkoutDataVo->getSubId(),
                $checkoutDataVo->getAmount(),
                $checkoutDataVo->getCurrency(),
                $checkoutDataVo->getOkUrl(),
                $checkoutDataVo->getNokUrl(),
                $checkoutDataVo->getMerchantclientId(),
                $checkoutDataVo->getPnUrl(),
                $checkoutDataVo->getClientIp()
            );

            if ($response->resultCode == 0 && $response->errorCode == 0)
            {
                return $checkoutDataVo->getUserPanelRedirectUrl() .
                '?mid=' . $checkoutDataVo->getMid() .
                '&mtid=' . $checkoutDataVo->getMtid() .
                '&amount=' . $checkoutDataVo->getAmount() .
                '&currency=' . $checkoutDataVo->getCurrency() .
                '&subId=' . $checkoutDataVo->getSubId();
            }

            return FALSE;
        }

    }