<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive;

    use Simplon\Payment\Iface\ProviderAuthInterface;
    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\ChargeCustomDataVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\PaypalAuthVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\PaypalChargeVo;
    use Simplon\Payment\Vo\ChargeVo;

    class Paypal
    {
        /** @var  PaypalAuthVo */
        protected $_authVo;

        /**
         * @param ProviderAuthInterface $authVo
         */
        public function __construct(ProviderAuthInterface $authVo)
        {
            /** @var $authVo PaypalAuthVo */
            $this->_setAuthVo($authVo);

            PaypalApiRequests::setUsername($authVo->getUsername());
            PaypalApiRequests::setPassword($authVo->getPassword());
            PaypalApiRequests::setSignature($authVo->getSignature());
            PaypalApiRequests::setAppId($authVo->getAppId());
            PaypalApiRequests::setSandbox($authVo->getSandbox());
        }

        // ######################################

        /**
         * @param PaypalAuthVo $authVo
         *
         * @return Paypal
         */
        protected function _setAuthVo(PaypalAuthVo $authVo)
        {
            $this->_authVo = $authVo;

            return $this;
        }

        // ######################################

        /**
         * @return PaypalAuthVo
         */
        protected function _getAuthVo()
        {
            return $this->_authVo;
        }

        // ######################################

        /**
         * @param $payKey
         *
         * @return bool|PaypalChargeVo
         */
        public function getCharge($payKey)
        {
            $response = PaypalApiRequests::request(
                PaypalApiConstants::PATH_PAYMENT_DETAILS_RETRIEVE,
                [
                    'payKey'                        => $payKey,
                    'requestEnvelope.errorLanguage' => 'en_US',
                ]
            );

            if ($response !== FALSE)
            {
                return (new PaypalChargeVo())->setData($response);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return bool
         * @throws \Simplon\Payment\PaymentException
         */
        public function isValidCharge(ChargeVo $chargeVo)
        {
            $response = $this->_isValidCharge($chargeVo);

            if ($response !== FALSE)
            {
                return TRUE;
            }

            /** @var ChargeCustomDataVo $chargeCustomDataVo */
            $chargeCustomDataVo = $chargeVo->getCustomDataVo();

            $appId = $this->_getAuthVo()
                ->getAppId();

            throw new PaymentException(
                PaymentExceptionConstants::ERR_PAYMENT_DATA_CODE,
                PaymentExceptionConstants::ERR_PAYMENT_DATA_MESSAGE,
                [
                    'provider' => 'Paypal Adaptive Payments',
                    'payKey'   => $chargeCustomDataVo->getPayKey(),
                    'appId'    => $appId,
                ]
            );
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return bool
         */
        protected function _isValidCharge(ChargeVo $chargeVo)
        {
            /** @var ChargeCustomDataVo $chargeCustomDataVo */
            $chargeCustomDataVo = $chargeVo->getCustomDataVo();

            // get charge from paypal
            $paypalChargeVo = $this->getCharge($chargeCustomDataVo->getPayKey());

            if ($paypalChargeVo === FALSE)
            {
                return FALSE;
            }

            // ------------------------------

            $validStatus = $this->_testStringIsEqual(
                $paypalChargeVo->getStatus(),
                'COMPLETED'
            );

            if ($validStatus === FALSE)
            {
                return FALSE;
            }

            // ------------------------------

            $validCurrency = $this->_testStringIsEqual(
                $paypalChargeVo->getCurrencyCode(),
                $chargeVo->getCurrency()
            );

            if ($validCurrency === FALSE)
            {
                return FALSE;
            }

            // ------------------------------

            $paypalChargePaymentInfoVo = $paypalChargeVo->getPaypalChargePaymentInfoVo();

            // does it exist?
            $validPaymentInfo = $paypalChargePaymentInfoVo !== FALSE ? TRUE : FALSE;

            if ($validPaymentInfo === FALSE)
            {
                return FALSE;
            }

            // ------------------------------

            $paypalChargePaymentInfoReceiverVo = $paypalChargeVo
                ->getPaypalChargePaymentInfoVo()
                ->getPaypalChargePaymentInfoReceiverVo();

            /** @var ChargeCustomDataVo $chargeCustomDataVo */
            $chargeCustomDataVo = $chargeVo->getCustomDataVo();

            $accountEmail = $this->_getAuthVo()
                ->getEmail();

            $validReceiver = $this->_testStringIsEqual(
                $paypalChargePaymentInfoReceiverVo->getEmail(),
                $accountEmail
            );

            if ($validReceiver === FALSE)
            {
                return FALSE;
            }

            // ------------------------------

            $validAmount = $paypalChargePaymentInfoReceiverVo->getAmountCents() === $chargeVo->getTotalAmountCents() ? TRUE : FALSE;

            if ($validAmount === FALSE)
            {
                return FALSE;
            }

            // ------------------------------

            $validSenderTransactionStatus = $this->_testStringIsEqual(
                $paypalChargePaymentInfoVo->getSenderTransactionStatus(),
                'COMPLETED'
            );

            if ($validSenderTransactionStatus === FALSE)
            {
                return FALSE;
            }

            // ------------------------------

            return TRUE;
        }

        // ######################################

        /**
         * @param $a
         * @param $b
         *
         * @return bool
         */
        protected function _testStringIsEqual($a, $b)
        {
            return strtoupper($a) === strtoupper($b) ? TRUE : FALSE;
        }
    }