<?php

    namespace Simplon\Payment\Provider\IcepayIdeal\Vo;

    class ChargePostbackVo
    {
        protected $_status;
        protected $_statusCode;
        protected $_merchant;
        protected $_orderId;
        protected $_paymentId;
        protected $_reference;
        protected $_transactionId;
        protected $_consumerName;
        protected $_consumerAccountNumber;
        protected $_consumerAddress;
        protected $_consumerHouseNumber;
        protected $_consumerCity;
        protected $_consumerCountry;
        protected $_consumerEmail;
        protected $_consumerPhoneNumber;
        protected $_consumerIpAddress;
        protected $_amountCents;
        protected $_currency;
        protected $_processDuration;
        protected $_paymentMethod;

        // ######################################

        /**
         * @param mixed $amountCents
         *
         * @return ChargePostbackVo
         */
        public function setAmountCents($amountCents)
        {
            $this->_amountCents = $amountCents;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getAmountCents()
        {
            return (int)$this->_amountCents;
        }

        // ######################################

        /**
         * @param mixed $consumerAccountNumber
         *
         * @return ChargePostbackVo
         */
        public function setConsumerAccountNumber($consumerAccountNumber)
        {
            $this->_consumerAccountNumber = $consumerAccountNumber;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerAccountNumber()
        {
            return (string)$this->_consumerAccountNumber;
        }

        // ######################################

        /**
         * @param mixed $consumerAddress
         *
         * @return ChargePostbackVo
         */
        public function setConsumerAddress($consumerAddress)
        {
            $this->_consumerAddress = $consumerAddress;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerAddress()
        {
            return (string)$this->_consumerAddress;
        }

        // ######################################

        /**
         * @param mixed $consumerCity
         *
         * @return ChargePostbackVo
         */
        public function setConsumerCity($consumerCity)
        {
            $this->_consumerCity = $consumerCity;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerCity()
        {
            return (string)$this->_consumerCity;
        }

        // ######################################

        /**
         * @param mixed $consumerCountry
         *
         * @return ChargePostbackVo
         */
        public function setConsumerCountry($consumerCountry)
        {
            $this->_consumerCountry = $consumerCountry;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerCountry()
        {
            return (string)$this->_consumerCountry;
        }

        // ######################################

        /**
         * @param mixed $consumerEmail
         *
         * @return ChargePostbackVo
         */
        public function setConsumerEmail($consumerEmail)
        {
            $this->_consumerEmail = $consumerEmail;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerEmail()
        {
            return (string)$this->_consumerEmail;
        }

        // ######################################

        /**
         * @param mixed $consumerHouseNumber
         *
         * @return ChargePostbackVo
         */
        public function setConsumerHouseNumber($consumerHouseNumber)
        {
            $this->_consumerHouseNumber = $consumerHouseNumber;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerHouseNumber()
        {
            return (string)$this->_consumerHouseNumber;
        }

        // ######################################

        /**
         * @param mixed $consumerName
         *
         * @return ChargePostbackVo
         */
        public function setConsumerName($consumerName)
        {
            $this->_consumerName = $consumerName;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerName()
        {
            return (string)$this->_consumerName;
        }

        // ######################################

        /**
         * @param mixed $consumerPhoneNumber
         *
         * @return ChargePostbackVo
         */
        public function setConsumerPhoneNumber($consumerPhoneNumber)
        {
            $this->_consumerPhoneNumber = $consumerPhoneNumber;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerPhoneNumber()
        {
            return (string)$this->_consumerPhoneNumber;
        }

        // ######################################

        /**
         * @param mixed $consumerIpAddress
         *
         * @return ChargePostbackVo
         */
        public function setConsumerIpAddress($consumerIpAddress)
        {
            $this->_consumerIpAddress = $consumerIpAddress;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getConsumerIpAddress()
        {
            return (string)$this->_consumerIpAddress;
        }

        // ######################################

        /**
         * @param mixed $currency
         *
         * @return ChargePostbackVo
         */
        public function setCurrency($currency)
        {
            $this->_currency = $currency;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCurrency()
        {
            return (string)$this->_currency;
        }

        // ######################################

        /**
         * @param mixed $merchant
         *
         * @return ChargePostbackVo
         */
        public function setMerchant($merchant)
        {
            $this->_merchant = $merchant;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getMerchant()
        {
            return (int)$this->_merchant;
        }

        // ######################################

        /**
         * @param mixed $orderId
         *
         * @return ChargePostbackVo
         */
        public function setOrderId($orderId)
        {
            $this->_orderId = $orderId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getOrderId()
        {
            return (string)$this->_orderId;
        }

        // ######################################

        /**
         * @param mixed $paymentId
         *
         * @return ChargePostbackVo
         */
        public function setPaymentId($paymentId)
        {
            $this->_paymentId = $paymentId;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getPaymentId()
        {
            return (int)$this->_paymentId;
        }

        // ######################################

        /**
         * @param mixed $paymentMethod
         *
         * @return ChargePostbackVo
         */
        public function setPaymentMethod($paymentMethod)
        {
            $this->_paymentMethod = $paymentMethod;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPaymentMethod()
        {
            return (string)$this->_paymentMethod;
        }

        // ######################################

        /**
         * @param mixed $processDuration
         *
         * @return ChargePostbackVo
         */
        public function setProcessDuration($processDuration)
        {
            $this->_processDuration = $processDuration;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getProcessDuration()
        {
            return (int)$this->_processDuration;
        }

        // ######################################

        /**
         * @param mixed $reference
         *
         * @return ChargePostbackVo
         */
        public function setReference($reference)
        {
            $this->_reference = $reference;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getReference()
        {
            return (string)$this->_reference;
        }

        // ######################################

        /**
         * @param mixed $status
         *
         * @return ChargePostbackVo
         */
        public function setStatus($status)
        {
            $this->_status = $status;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getStatus()
        {
            return (string)$this->_status;
        }

        // ######################################

        /**
         * @param mixed $statusCode
         *
         * @return ChargePostbackVo
         */
        public function setStatusCode($statusCode)
        {
            $this->_statusCode = $statusCode;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getStatusCode()
        {
            return (string)$this->_statusCode;
        }

        // ######################################

        /**
         * @param mixed $transactionId
         *
         * @return ChargePostbackVo
         */
        public function setTransactionId($transactionId)
        {
            $this->_transactionId = $transactionId;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getTransactionId()
        {
            return (int)$this->_transactionId;
        }
    } 