<?php

    namespace Simplon\Payment\Provider\PaypalRest;

    use Simplon\Payment\ChargeStateConstants;
    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeExecuteVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeResponseVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeValidationResponseVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeValidationVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\PaypalAuthVo;

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
                ->setPaymentId($paypalChargeVo->getId())
                ->setUrlApproval($paypalChargeLinksVo->getUrlApproval());

            $simplonChargeStatus = $this->_convertPaypalStateToSimplonState($paypalChargeVo->getState());

            // ----------------------------------

            return (new ChargeResponseVo())
                ->setChargeVo($chargeVo)
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
                $simplonState = $this->_convertPaypalStateToSimplonState($paypalSaleVo->getState());

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
                $paypalSaleVo = $paypalChargeVo
                    ->getPaypalChargeTransactionVoMany()[0]
                    ->getPaypalSaleVo();

                $simplonState = $this->_convertPaypalStateToSimplonState($paypalSaleVo->getState());

                return (new ChargeValidationResponseVo())
                    ->setTransactionId($paypalSaleVo->getId())
                    ->setStatus($simplonState);
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