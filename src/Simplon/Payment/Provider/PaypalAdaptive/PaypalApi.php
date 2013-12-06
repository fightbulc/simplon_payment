<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive;

    use Simplon\Payment\PaymentHelper;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\ChargeValidationVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\PaypalAuthVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\PaypalChargeVo;

    class PaypalApi
    {
        /** @var  PaypalAuthVo */
        protected $_authVo;

        // ######################################

        /**
         * @param PaypalAuthVo $authVo
         */
        public function __construct(PaypalAuthVo $authVo)
        {
            $this->_authVo = $authVo;

            PaypalApiRequests::setUsername($authVo->getUsername());
            PaypalApiRequests::setPassword($authVo->getPassword());
            PaypalApiRequests::setSignature($authVo->getSignature());
            PaypalApiRequests::setAppId($authVo->getAppId());
            PaypalApiRequests::setSandbox($authVo->getSandbox());
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
         * @return bool
         */
        protected function _isSandbox()
        {
            return $this->_getAuthVo()
                ->getSandbox();
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
         * @param PaypalChargeVo $paypalChargeVo
         *
         * @return bool
         */
        public function isValidCharge(ChargeValidationVo $chargeValidationVo, PaypalChargeVo $paypalChargeVo)
        {
            $expectedAuthState = 'COMPLETED';

            $validState = PaymentHelper::isStringEqual(
                $expectedAuthState,
                $paypalChargeVo->getStatus()
            );

            if ($validState === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Status doesnt match the expected",
                    $expectedAuthState,
                    $paypalChargeVo->getStatus()
                );
            }

            // ------------------------------

            // sandbox only accepts USD
            $expectedCurrency = $this->_isSandbox() === TRUE ? 'USD' : $chargeValidationVo->getCurrency();
            $receivedCurrency = $paypalChargeVo->getCurrencyCode();

            $validCurrency = PaymentHelper::isStringEqual($receivedCurrency, $expectedCurrency);

            if ($validCurrency === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Currencies don't match up",
                    $expectedCurrency,
                    $receivedCurrency
                );
            }

            // ------------------------------

            $paypalChargePaymentInfoVo = $paypalChargeVo->getPaypalChargePaymentInfoVo();

            if ($paypalChargePaymentInfoVo === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Missing paypal's paymentInfo object"
                );
            }

            $paypalChargePaymentInfoReceiverVo = $paypalChargePaymentInfoVo->getPaypalChargePaymentInfoReceiverVo();

            $expectedEmail = $this
                ->_getAuthVo()
                ->getEmail();

            $validReceiver = PaymentHelper::isStringEqual(
                $expectedEmail,
                $paypalChargePaymentInfoReceiverVo->getEmail()
            );

            if ($validReceiver === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Email doesn't match up",
                    $expectedEmail,
                    $paypalChargePaymentInfoReceiverVo->getEmail()
                );
            }

            // ------------------------------

            $validAmount = PaymentHelper::isIntegerEqual(
                $chargeValidationVo->getTotalAmountCents(),
                $paypalChargePaymentInfoReceiverVo->getAmountCents()
            );

            if ($validAmount === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Charge amounts don't match up",
                    $chargeValidationVo->getTotalAmountCents(),
                    $paypalChargePaymentInfoReceiverVo->getAmountCents()
                );
            }

            // ------------------------------

            $expectedTransactionStatus = 'COMPLETED';

            $validSenderTransactionStatus = PaymentHelper::isStringEqual(
                $expectedTransactionStatus,
                $paypalChargePaymentInfoVo->getSenderTransactionStatus()
            );

            if ($validSenderTransactionStatus === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Transaction status doesn't match up",
                    $expectedTransactionStatus,
                    $paypalChargePaymentInfoVo->getSenderTransactionStatus()
                );
            }

            // ------------------------------

            return TRUE;
        }
    }