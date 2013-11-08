<?php

    namespace Simplon\Payment\Provider\Paypal\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class PaypalPayerVo
    {
        protected $_paymentMethod;
        protected $_payerInfo;

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalPayerVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('payment_method', function ($val) { $this->setPaymentMethod($val); })
                ->setConditionByKey('payer_info', function ($val) { $this->setPayerInfo($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $payerInfo
         *
         * @return PaypalPayerVo
         */
        public function setPayerInfo($payerInfo)
        {
            $this->_payerInfo = $payerInfo;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getPayerInfo()
        {
            return $this->_payerInfo;
        }

        // ######################################

        /**
         * @param mixed $paymentMethod
         *
         * @return PaypalPayerVo
         */
        public function setPaymentMethod($paymentMethod)
        {
            $this->_paymentMethod = $paymentMethod;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getPaymentMethod()
        {
            return $this->_paymentMethod;
        }
    }