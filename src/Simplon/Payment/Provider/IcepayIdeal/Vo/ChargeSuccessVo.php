<?php

    namespace Simplon\Payment\Provider\IcepayIdeal\Vo;

    use Simplon\Helper\VoSetDataFactory;
    use Simplon\Payment\ChargeStateConstants;

    class ChargeSuccessVo
    {
        protected $_status;
        protected $_statusCode;
        protected $_merchantId;
        protected $_orderId;
        protected $_paymentId;
        protected $_reference;
        protected $_transactionId;
        protected $_checksum;

        // ######################################

        /**
         * @param array $data
         */
        public function __construct(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('Status', function ($val) { $this->setStatus($val); })
                ->setConditionByKey('StatusCode', function ($val) { $this->setStatusCode($val); })
                ->setConditionByKey('Merchant', function ($val) { $this->setMerchantId($val); })
                ->setConditionByKey('OrderID', function ($val) { $this->setOrderId($val); })
                ->setConditionByKey('PaymentID', function ($val) { $this->setPaymentId($val); })
                ->setConditionByKey('Reference', function ($val) { $this->setReference($val); })
                ->setConditionByKey('TransactionID', function ($val) { $this->setTransactionId($val); })
                ->setConditionByKey('Checksum', function ($val) { $this->setChecksum($val); })
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
                    "%s|%s|%s|%s|%s|%s|%s|%s",
                    $secretCode,
                    $this->getMerchantId(),
                    $this->getStatus(),
                    $this->getStatusCode(),
                    $this->getOrderId(),
                    $this->getPaymentId(),
                    $this->getReference(),
                    $this->getTransactionId()
                )
            );

            return $checksum === $this->getChecksum();
        }

        // ######################################

        /**
         * @param mixed $checksum
         *
         * @return ChargeSuccessVo
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
         * @param mixed $merchantId
         *
         * @return ChargeSuccessVo
         */
        public function setMerchantId($merchantId)
        {
            $this->_merchantId = $merchantId;

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
         * @return ChargeSuccessVo
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
         * @return ChargeSuccessVo
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
         * @param mixed $reference
         *
         * @return ChargeSuccessVo
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
         * @return ChargeSuccessVo
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
         * @return ChargeSuccessVo
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
            return (string)urldecode($this->_statusCode);
        }

        // ######################################

        /**
         * @param mixed $transactionId
         *
         * @return ChargeSuccessVo
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