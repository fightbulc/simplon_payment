<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive;

    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\ChargeValidationVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\PaypalAuthVo;
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
         * @param ChargeValidationVo $chargeValidationVo
         *
         * @return ChargeResponseVo
         * @throws \Simplon\Payment\PaymentException
         */
        public function isValidCharge(ChargeValidationVo $chargeValidationVo)
        {
            // get charge from paypal
            $paypalChargeVo = $this->_getPaypalApiInstance()
                ->getCharge($chargeValidationVo->getPayKey());

            // validate response
            $validationResponse = $this->_getPaypalApiInstance()
                ->isValidCharge($chargeValidationVo, $paypalChargeVo);

            if ($validationResponse === TRUE)
            {
                $transactionId = $paypalChargeVo
                    ->getPaypalChargePaymentInfoVo()
                    ->getTransactionId();

                return (new ChargeResponseVo())->setTransactionId($transactionId);
            }

            // ----------------------------------

            throw new PaymentException(
                PaymentExceptionConstants::ERR_PAYMENT_DATA_CODE,
                PaymentExceptionConstants::ERR_PAYMENT_DATA_MESSAGE,
                [
                    'provider' => 'Paypal Adaptive Payments',
                    'payKey'   => $chargeValidationVo->getPayKey(),
                    'error'    => $validationResponse,
                ]
            );
        }
    }