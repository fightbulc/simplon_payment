<?php

    namespace Simplon\Payment\Provider\IcepayIdeal;

    use Simplon\Payment\Provider\IcepayIdeal\Vo\ChargePostbackVo;
    use Simplon\Payment\Provider\IcepayIdeal\Vo\ChargeResponseVo;
    use Simplon\Payment\Provider\IcepayIdeal\Vo\ChargeVo;
    use Simplon\Payment\Provider\IcepayIdeal\Vo\IcepayAuthVo;

    class IcepayIdeal
    {
        /** @var  IcepayAuthVo */
        protected $_authVo;

        // ######################################

        /**
         * @param IcepayAuthVo $authVo
         */
        public function __construct(IcepayAuthVo $authVo)
        {
            $this->_authVo = $authVo;
        }

        // ######################################

        /**
         * @return IcepayAuthVo
         */
        protected function _getAuthVo()
        {
            return $this->_authVo;
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return ChargeResponseVo
         */
        public function authoriseCharge(ChargeVo $chargeVo)
        {
            $paymentObj = (new \Icepay_PaymentObject())
                ->setPaymentMethod((new \Icepay_Paymentmethod_Ideal())->getCode())
                ->setDescription($chargeVo->getDescription())
                ->setAmount($chargeVo->getTotalAmountCents())
                ->setIssuer($chargeVo->getIssuer())
                ->setCountry('NL')
                ->setLanguage('NL')
                ->setCurrency($chargeVo->getCurrency())
                ->setOrderID($chargeVo->getReferenceId());

            // ----------------------------------

            $authVo = $this->_getAuthVo();

            $transactionObject = (new \Icepay_Api_Webservice())
                ->paymentService()
                ->setMerchantID($authVo->getMerchantId())
                ->setSecretCode($authVo->getSecretCode())
                ->setSuccessURL($chargeVo->getUrlSuccess())
                ->setErrorURL($chargeVo->getUrlError())
                ->checkOut($paymentObj);

            // ----------------------------------

            $chargeResponseVo = (new ChargeResponseVo())
                ->setPaymentId($transactionObject->getPaymentID())
                ->setUrlApproval($transactionObject->getPaymentScreenURL())
                ->setChargeVo($chargeVo);

            return $chargeResponseVo;
        }

        // ######################################

        /**
         * @return bool|ChargePostbackVo
         */
        public function isValidPostback()
        {
            $authVo = $this->_getAuthVo();

            $api = (new \Icepay_Postback())
                ->setMerchantID($authVo->getMerchantId())
                ->setSecretCode($authVo->getSecretCode());

            // validates the POST data
            $isValid = $api->validate();

            // ----------------------------------

            if ($isValid !== FALSE)
            {
                $postbackObj = $api->getPostback();

                return (new ChargePostbackVo())
                    ->setStatus($postbackObj->status)
                    ->setStatusCode($postbackObj->statusCode)
                    ->setMerchant($postbackObj->merchant)
                    ->setOrderId($postbackObj->orderID)
                    ->setPaymentId($postbackObj->paymentID)
                    ->setReference($postbackObj->reference)
                    ->setTransactionId($postbackObj->transactionID)
                    ->setConsumerName($postbackObj->consumerName)
                    ->setConsumerAccountNumber($postbackObj->consumerAccountNumber)
                    ->setConsumerAddress($postbackObj->consumerAddress)
                    ->setConsumerHouseNumber($postbackObj->consumerHouseNumber)
                    ->setConsumerCity($postbackObj->consumerCity)
                    ->setConsumerCountry($postbackObj->consumerCountry)
                    ->setConsumerEmail($postbackObj->consumerEmail)
                    ->setConsumerPhoneNumber($postbackObj->consumerPhoneNumber)
                    ->setConsumerIpAddress($postbackObj->consumerIPAdress)
                    ->setAmountCents($postbackObj->amount)
                    ->setProcessDuration($postbackObj->duration)
                    ->setPaymentMethod($postbackObj->paymentMethod);
            }

            return FALSE;
        }
    }