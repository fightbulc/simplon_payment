<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class PaypalChargePaymentInfoReceiverVo
    {
        protected $_accountId;
        protected $_paymentType;
        protected $_primary;
        protected $_email;
        protected $_amount;

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalChargePaymentInfoReceiverVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('accountId', function ($val) { $this->setAccountId($val); })
                ->setConditionByKey('paymentType', function ($val) { $this->setPaymentType($val); })
                ->setConditionByKey('primary', function ($val) { $this->setPrimary($val); })
                ->setConditionByKey('email', function ($val) { $this->setEmail($val); })
                ->setConditionByKey('amount', function ($val) { $this->setAmount($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $accountId
         *
         * @return PaypalChargePaymentInfoReceiverVo
         */
        public function setAccountId($accountId)
        {
            $this->_accountId = $accountId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getAccountId()
        {
            return (string)$this->_accountId;
        }

        // ######################################

        /**
         * @param mixed $amountCents
         *
         * @return PaypalChargePaymentInfoReceiverVo
         */
        public function setAmount($amountCents)
        {
            $this->_amount = $amountCents;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getAmountCents()
        {
            return (int)((float)$this->_amount * 100);
        }

        // ######################################

        /**
         * @param mixed $email
         *
         * @return PaypalChargePaymentInfoReceiverVo
         */
        public function setEmail($email)
        {
            $this->_email = $email;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getEmail()
        {
            return (string)$this->_email;
        }

        // ######################################

        /**
         * @param mixed $paymentType
         *
         * @return PaypalChargePaymentInfoReceiverVo
         */
        public function setPaymentType($paymentType)
        {
            $this->_paymentType = $paymentType;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPaymentType()
        {
            return (string)$this->_paymentType;
        }

        // ######################################

        /**
         * @param mixed $primary
         *
         * @return PaypalChargePaymentInfoReceiverVo
         */
        public function setPrimary($primary)
        {
            $this->_primary = $primary;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getPrimary()
        {
            return $this->_primary !== 'false' ? TRUE : FALSE;
        }
    } 