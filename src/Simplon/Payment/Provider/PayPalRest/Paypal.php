<?php

    namespace Simplon\Payment\Provider\PaypalRest;

    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeExecuteVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeValidationVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\PaypalAuthVo;
    use Simplon\Payment\Vo\ChargeResponseVo;

    class Paypal
    {
        /** @var  PaypalAuthVo */
        protected $_authVo;

        /** @var  PaypalApi */
        protected $_paypalApiInstance;

        // ######################################

        /**
         * @param PaypalAuthVo $authVo
         */
        public function __construct(PaypalAuthVo $authVo)
        {
            $this->_authVo = $authVo;
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
         * @return PaypalApi
         */
        protected function _getPaypalApiInstance()
        {
            if (!$this->_paypalApiInstance)
            {
                $this->_paypalApiInstance = new PaypalApi($this->_getAuthVo());
            }

            return $this->_paypalApiInstance;
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return ChargeResponseVo
         */
        public function authoriseCharge(ChargeVo $chargeVo)
        {
            $paypalChargeVo = $this->_getPaypalApiInstance()
                ->authoriseCharge($chargeVo);

            // ----------------------------------

            $paypalChargeLinksVo = $paypalChargeVo->getPaypalChargeLinksVo();

            $chargeVo
                ->setUrlApproval($paypalChargeLinksVo->getUrlApproval())
                ->setPaymentId($paypalChargeVo->getId());

            $simplonChargeStatus = $this->_getPaypalApiInstance()
                ->convertPaypalStateToSimplonState($paypalChargeVo->getState());

            // ----------------------------------

            return (new ChargeResponseVo())
                ->setReferenceId($chargeVo->getReferenceId())
                ->setDescription($chargeVo->getDescription())
                ->setCurrency($chargeVo->getCurrency())
                ->setChargePayerVo($chargeVo->getChargePayerVo())
                ->setChargeProductVoMany($chargeVo->getChargeProductVoMany())
                ->setStatus($simplonChargeStatus);
        }

        // ######################################

        /**
         * @param ChargeExecuteVo $chargeExecuteVo
         *
         * @return bool|ChargeResponseVo
         */
        public function executeCharge(ChargeExecuteVo $chargeExecuteVo)
        {
            $paypalChargeVo = $this->_getPaypalApiInstance()
                ->executeCharge($chargeExecuteVo);

            // ----------------------------------

            // get transactions
            $paypalChargeTransactionVoMany = $paypalChargeVo->getPaypalChargeTransactionVoMany();
            $paypalChargeTransactionVo = $paypalChargeTransactionVoMany[0];

            // get paypalSaleVo
            $paypalSaleVo = $paypalChargeTransactionVo->getPaypalSaleVo();

            if ($paypalSaleVo !== FALSE)
            {
                $simplonState = $this->_getPaypalApiInstance()
                    ->convertPaypalStateToSimplonState($paypalSaleVo->getState());

                return (new ChargeResponseVo())
                    ->setTransactionId($paypalSaleVo->getId())
                    ->setStatus($simplonState);
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
            $paypalChargeVo = $this->_getPaypalApiInstance()
                ->getCharge($chargeValidationVo->getPaymentId());

            $validationResponse = $this->_getPaypalApiInstance()
                ->isValidCharge($chargeValidationVo, $paypalChargeVo);

            // ----------------------------------

            if ($validationResponse === TRUE)
            {
                $transactionId = $paypalChargeVo
                    ->getPaypalChargeTransactionVoMany()[0]
                    ->getPaypalSaleVo()
                    ->getId();

                return (new ChargeResponseVo())->setTransactionId($transactionId);
            }

            // ----------------------------------

            throw new PaymentException(
                PaymentExceptionConstants::ERR_PAYMENT_DATA_CODE,
                PaymentExceptionConstants::ERR_PAYMENT_DATA_MESSAGE,
                [
                    'provider'  => 'Paypal REST Payments',
                    'paymentId' => $chargeValidationVo->getPaymentId(),
                    'error'     => $validationResponse,
                ]
            );
        }
    }