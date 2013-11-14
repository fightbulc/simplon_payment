<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive;

    use Simplon\Payment\Iface\ProviderAuthInterface;
    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\ChargeValidationVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\PaypalAuthVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\PaypalChargeVo;
    use Simplon\Payment\Vo\ChargeResponseVo;

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
         * @param ChargeValidationVo $chargeValidationVo
         *
         * @return ChargeResponseVo
         * @throws \Simplon\Payment\PaymentException
         */
        public function isValidCharge(ChargeValidationVo $chargeValidationVo)
        {
            // get charge from paypal
            $paypalChargeVo = $this->getCharge($chargeValidationVo->getPayKey());

            // validate response
            $response = $this->_isValidCharge($chargeValidationVo, $paypalChargeVo);

            // all cool, pass back transaction id
            if ($response !== FALSE)
            {
                $transactionId = $paypalChargeVo
                    ->getPaypalChargePaymentInfoVo()
                    ->getTransactionId();

                return (new ChargeResponseVo())->setTransactionId($transactionId);
            }

            // ----------------------------------

            $appId = $this->_getAuthVo()
                ->getAppId();

            throw new PaymentException(
                PaymentExceptionConstants::ERR_PAYMENT_DATA_CODE,
                PaymentExceptionConstants::ERR_PAYMENT_DATA_MESSAGE,
                [
                    'provider' => 'Paypal Adaptive Payments',
                    'payKey'   => $chargeValidationVo->getPayKey(),
                    'appId'    => $appId,
                ]
            );
        }

        // ######################################

        /**
         * @param ChargeValidationVo $chargeValidationVo
         * @param PaypalChargeVo $paypalChargeVo
         *
         * @return bool
         */
        protected function _isValidCharge(ChargeValidationVo $chargeValidationVo, PaypalChargeVo $paypalChargeVo)
        {
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
                $chargeValidationVo->getCurrency()
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

            $accountEmail = $this
                ->_getAuthVo()
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

            $validAmount = $paypalChargePaymentInfoReceiverVo->getAmountCents() === $chargeValidationVo->getTotalAmountCents() ? TRUE : FALSE;

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