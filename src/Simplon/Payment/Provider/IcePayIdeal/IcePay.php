<?php

    namespace Simplon\Payment\Provider\IcePayIdeal;

    use Simplon\Payment\Provider\IcePayIdeal\Vo\ChargeResponseVo;
    use Simplon\Payment\Provider\IcePayIdeal\Vo\ChargeVo;
    use Simplon\Payment\Provider\IcePayIdeal\Vo\IcePayAuthVo;

    class IcePay
    {
        /** @var  IcePayAuthVo */
        protected $_authVo;

        // ######################################

        /**
         * @param IcePayAuthVo $authVo
         */
        public function __construct(IcePayAuthVo $authVo)
        {
            $this->_authVo = $authVo;
        }

        // ######################################

        /**
         * @return IcePayAuthVo
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
                ->setIssuer('ING')
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
                ->setSuccessURL('http://beatguide.me/success')
                ->setErrorURL('http://beatguide.me/error')
                ->checkOut($paymentObj);

            var_dump($transactionObject);

            $chargeVo->setUrlApproval($transactionObject->getPaymentScreenURL());

            // ----------------------------------

            $chargeResponseVo = (new ChargeResponseVo())->setChargeVo($chargeVo);

            return $chargeResponseVo;
        }

        // ######################################

        public function executeCharge()
        {
        }
    }