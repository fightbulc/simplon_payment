<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class PaypalChargePaymentInfoVo
    {
        protected $_senderTransactionStatus;
        protected $_senderTransactionId;
        protected $_pendingRefund;
        protected $_refundedAmount;
        protected $_receiver;
        protected $_transactionStatus;
        protected $_transactionId;

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalChargePaymentInfoVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('senderTransactionStatus', function ($val) { $this->setSenderTransactionStatus($val); })
                ->setConditionByKey('senderTransactionId', function ($val) { $this->setSenderTransactionId($val); })
                ->setConditionByKey('pendingRefund', function ($val) { $this->setPendingRefund($val); })
                ->setConditionByKey('refundedAmount', function ($val) { $this->setRefundedAmount($val); })
                ->setConditionByKey('receiver', function ($val) { $this->setReceiver($val); })
                ->setConditionByKey('transactionStatus', function ($val) { $this->setTransactionStatus($val); })
                ->setConditionByKey('transactionId', function ($val) { $this->setTransactionId($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $pendingRefund
         *
         * @return PaypalChargePaymentInfoVo
         */
        public function setPendingRefund($pendingRefund)
        {
            $this->_pendingRefund = $pendingRefund;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getPendingRefund()
        {
            return $this->_pendingRefund !== 'false' ? TRUE : FALSE;
        }

        // ######################################

        /**
         * @param mixed $receiver
         *
         * @return PaypalChargePaymentInfoVo
         */
        public function setReceiver($receiver)
        {
            $this->_receiver = $receiver;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        public function getReceiver()
        {
            return (array)$this->_receiver;
        }

        // ######################################

        /**
         * @return bool|PaypalChargePaymentInfoReceiverVo
         */
        public function getPaypalChargePaymentInfoReceiverVo()
        {
            $receiver = $this->getReceiver();

            if (is_array($receiver))
            {
                return (new PaypalChargePaymentInfoReceiverVo())->setData($receiver);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param mixed $refundedAmount
         *
         * @return PaypalChargePaymentInfoVo
         */
        public function setRefundedAmount($refundedAmount)
        {
            $this->_refundedAmount = $refundedAmount;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getRefundedAmountCents()
        {
            return (int)$this->_refundedAmount * 100;
        }

        // ######################################

        /**
         * @param mixed $senderTransactionId
         *
         * @return PaypalChargePaymentInfoVo
         */
        public function setSenderTransactionId($senderTransactionId)
        {
            $this->_senderTransactionId = $senderTransactionId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getSenderTransactionId()
        {
            return (string)$this->_senderTransactionId;
        }

        // ######################################

        /**
         * @param mixed $senderTransactionStatus
         *
         * @return PaypalChargePaymentInfoVo
         */
        public function setSenderTransactionStatus($senderTransactionStatus)
        {
            $this->_senderTransactionStatus = $senderTransactionStatus;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getSenderTransactionStatus()
        {
            return (string)$this->_senderTransactionStatus;
        }

        // ######################################

        /**
         * @param mixed $transactionId
         *
         * @return PaypalChargePaymentInfoVo
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

        // ######################################

        /**
         * @param mixed $transactionStatus
         *
         * @return PaypalChargePaymentInfoVo
         */
        public function setTransactionStatus($transactionStatus)
        {
            $this->_transactionStatus = $transactionStatus;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getTransactionStatus()
        {
            return (string)$this->_transactionStatus;
        }
    } 