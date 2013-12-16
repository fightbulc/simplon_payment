<?php

    namespace Simplon\Payment\Provider\IcepayIdeal;

    use Simplon\Payment\ChargeStateConstants;
    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;
    use Simplon\Payment\Provider\IcepayIdeal\Vo\ChargePostbackVo;
    use Simplon\Payment\Provider\IcepayIdeal\Vo\ChargeResponseVo;
    use Simplon\Payment\Provider\IcepayIdeal\Vo\ChargeSuccessVo;
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
         * @throws \Simplon\Payment\PaymentException
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

            try
            {
                $transactionObject = (new \Icepay_Api_Webservice())
                    ->paymentService()
                    ->setMerchantID($authVo->getMerchantId())
                    ->setSecretCode($authVo->getSecretCode())
                    ->setSuccessURL($chargeVo->getUrlSuccess())
                    ->setErrorURL($chargeVo->getUrlError())
                    ->checkOut($paymentObj);

                $chargeResponseVo = (new ChargeResponseVo())
                    ->setPaymentId($transactionObject->getPaymentID())
                    ->setUrlApproval($transactionObject->getPaymentScreenURL())
                    ->setChargeVo($chargeVo)
                    ->setStatus(ChargeStateConstants::CREATED);

                return $chargeResponseVo;
            }
            catch (\Exception $e)
            {
                throw new PaymentException(
                    PaymentExceptionConstants::ERR_REQUEST_CODE,
                    PaymentExceptionConstants::ERR_REQUEST_MESSAGE,
                    [
                        'provider' => 'Icepay Ideal',
                        'message'  => $e->getMessage(),
                    ]
                );
            }
        }

        // ######################################

        /**
         * @param array $getData
         *
         * @return bool|ChargeSuccessVo
         */
        public function isValidCheckout(array $getData)
        {
            $authVo = $this->_getAuthVo();

            // set vo
            $chargeSuccessVo = new ChargeSuccessVo($getData);

            // is valid data
            $isValid = $chargeSuccessVo->isValidChecksum($authVo->getSecretCode());

            if ($isValid !== FALSE)
            {
                return $chargeSuccessVo;
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param array $postData
         *
         * @return bool|ChargePostbackVo
         */
        public function isValidPostback(array $postData)
        {
            $authVo = $this->_getAuthVo();

            // set vo
            $chargePostbackVo = new ChargePostbackVo($postData);

            // is valid data
            $isValid = $chargePostbackVo->isValidChecksum($authVo->getSecretCode());

            if ($isValid !== FALSE)
            {
                return $chargePostbackVo;
            }

            return FALSE;
        }
    }