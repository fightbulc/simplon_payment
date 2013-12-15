<?php

    namespace Simplon\Payment\Provider\IcepayIdeal\Vo;

    use Simplon\Helper\VoSetDataFactory;
    use Simplon\Payment\ChargeStateConstants;

    class ChargePostbackVo
    {
        protected $_status;
        protected $_statusCode;
        protected $_merchantId;
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
        protected $_checksum;

        // ######################################

        /**
         * @param array $data
         */
        public function __construct(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('status', function ($val) { $this->setStatus($val); })
                ->setConditionByKey('statusCode', function ($val) { $this->setStatusCode($val); })
                ->setConditionByKey('merchant', function ($val) { $this->setMerchantId($val); })
                ->setConditionByKey('orderID', function ($val) { $this->setOrderId($val); })
                ->setConditionByKey('paymentID', function ($val) { $this->setPaymentId($val); })
                ->setConditionByKey('reference', function ($val) { $this->setReference($val); })
                ->setConditionByKey('transactionID', function ($val) { $this->setTransactionId($val); })
                ->setConditionByKey('consumerName', function ($val) { $this->setConsumerName($val); })
                ->setConditionByKey('consumerAccountName', function ($val) { $this->setConsumerAccountNumber($val); })
                ->setConditionByKey('consumerAddress', function ($val) { $this->setConsumerAddress($val); })
                ->setConditionByKey('consumerHouseNumber', function ($val) { $this->setConsumerHouseNumber($val); })
                ->setConditionByKey('consumerCity', function ($val) { $this->setConsumerCity($val); })
                ->setConditionByKey('consumerCountry', function ($val) { $this->setConsumerCountry($val); })
                ->setConditionByKey('consumerEmail', function ($val) { $this->setConsumerEmail($val); })
                ->setConditionByKey('consumerPhoneNumber', function ($val) { $this->setConsumerPhoneNumber($val); })
                ->setConditionByKey('consumerIPAddress', function ($val) { $this->setConsumerIpAddress($val); })
                ->setConditionByKey('amount', function ($val) { $this->setAmountCents($val); })
                ->setConditionByKey('currency', function ($val) { $this->setCurrency($val); })
                ->setConditionByKey('duration', function ($val) { $this->setProcessDuration($val); })
                ->setConditionByKey('paymentMethod', function ($val) { $this->setPaymentMethod($val); })
                ->setConditionByKey('checksum', function ($val) { $this->setChecksum($val); })
                ->run();
        }

        // ######################################

        /**
         * @param $secretCode
         *
         * @return bool
         */
        public function isValidChecksum($secretCode)
        {
            $checksum = sha1(
                sprintf(
                    "%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s",
                    $secretCode,
                    $this->getMerchantId(),
                    $this->getStatus(),
                    $this->getStatusCode(),
                    $this->getOrderId(),
                    $this->getPaymentId(),
                    $this->getReference(),
                    $this->getTransactionId(),
                    $this->getAmountCents(),
                    $this->getCurrency(),
                    $this->getProcessDuration(),
                    $this->getConsumerIpAddress()
                )
            );

            return $checksum === $this->getChecksum();
        }

        // ######################################

        /**
         * @param mixed $checksum
         *
         * @return ChargePostbackVo
         */
        public function setChecksum($checksum)
        {
            $this->_checksum = $checksum;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getChecksum()
        {
            return (string)$this->_checksum;
        }

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
        public function setMerchantId($merchant)
        {
            $this->_merchantId = $merchant;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getMerchantId()
        {
            return (int)$this->_merchantId;
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
         * @return string
         */
        public function getSimplonChargeStatus()
        {
            switch ($this->getStatus())
            {
                case \Icepay_StatusCode::OPEN:
                    $newStatus = ChargeStateConstants::PENDING;
                    break;

                // ------------------------------

                case \Icepay_StatusCode::SUCCESS:
                    $newStatus = ChargeStateConstants::COMPLETED;
                    break;

                // ------------------------------

                default:
                    $newStatus = ChargeStateConstants::FAILED;
            }

            return $newStatus;
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
         * @return string
         */
        public function getTransactionId()
        {
            return (string)$this->_transactionId;
        }
    } 