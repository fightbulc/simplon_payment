<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive;

    use Simplon\Payment\ChargeStateConstants;
    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\ChargeValidationResponseVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\ChargeValidationVo;
    use Simplon\Payment\Provider\PaypalAdaptive\Vo\PaypalAuthVo;
    use Simplon\Payment\Traits\ChargeResponseVoTrait;

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
         * @param $paypalState
         *
         * @return string
         */
        protected function _convertPaypalStateToSimplonState($paypalState)
        {
            switch ($paypalState)
            {
                case 'created':
                    $state = ChargeStateConstants::CREATED;
                    break;

                case 'processing':
                    $state = ChargeStateConstants::PROCESSING;
                    break;

                case 'pending':
                    $state = ChargeStateConstants::PENDING;
                    break;

                case 'completed':
                    $state = ChargeStateConstants::COMPLETED;
                    break;

                case 'failed':
                    $state = ChargeStateConstants::FAILED;
                    break;

                case 'refunded':
                    $state = ChargeStateConstants::REFUNDED;
                    break;

                case 'partially_refunded':
                    $state = ChargeStateConstants::REFUNDED;
                    break;

                case 'rejected':
                    $state = ChargeStateConstants::REJECTED;
                    break;

                case 'expired':
                    $state = ChargeStateConstants::INVALID;
                    break;

                default:
                    $state = ChargeStateConstants::UNKNOWN;
            }

            return $state;
        }

        // ######################################

        /**
         * @param ChargeValidationVo $chargeValidationVo
         *
         * @return ChargeValidationResponseVo
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
                $paypalChargePaymentInfoVo = $paypalChargeVo->getPaypalChargePaymentInfoVo();

                $simplonState = $this->_convertPaypalStateToSimplonState($paypalChargePaymentInfoVo->getTransactionStatus());

                return (new ChargeValidationResponseVo())
                    ->setTransactionId($paypalChargePaymentInfoVo->getTransactionId())
                    ->setStatus($simplonState);
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