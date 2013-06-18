<?php

    namespace Simplon\Payment\PaySafeCard;

    use Simplon\Payment\PaySafeCard\Lib\SOPGClassicMerchantClient;
    use Simplon\Payment\PaySafeCard\Vo\CheckoutPaySafeCardVo;

    class PaySafeCardStart extends PaySafeCardBase
    {
        protected $_resultCode;
        protected $_errorCode;

        #########################################

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

            $response = (new SOPGClassicMerchantClient($this->_endPoint))->createDisposition(
                $checkoutDataVo->getUsername(),
                $checkoutDataVo->getPassword(),
                $checkoutDataVo->getMtid(),
                $checkoutDataVo->getGameServerId(),
                $checkoutDataVo->getAmount(),
                $checkoutDataVo->getCurrency(),
                $checkoutDataVo->getOkUrl(),
                $checkoutDataVo->getNokUrl(),
                NULL,
                NULL,
                NULL
            );

            if ($response->resultCode == 0 && $response->errorCode == 0)
            {
                return $this->_clientPanelRedurectUrl .
                    '?mid=' . $checkoutDataVo->getMid() .
                    '&mtid=' . $checkoutDataVo->getMtid() .
                    '&amount=' . $checkoutDataVo->getAmount() .
                    '&currency=' . $checkoutDataVo->getCurrency() .
                    '&subId=' . $checkoutDataVo->getGameServerId();
            }

            return FALSE;
        }

    }