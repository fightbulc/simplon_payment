<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class PaypalChargeVo
    {
        protected $_sender;
        protected $_feesPayer;
        protected $_responseEnvelope;
        protected $_urlCancel;
        protected $_currencyCode;
        protected $_paymentInfoList;
        protected $_urlReturn;
        protected $_status;
        protected $_payKey;
        protected $_actionType;

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalChargeVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('sender', function ($val) { $this->setSender($val); })
                ->setConditionByKey('feesPayer', function ($val) { $this->setFeesPayer($val); })
                ->setConditionByKey('responseEnvelope', function ($val) { $this->setFeesPayer($val); })
                ->setConditionByKey('cancelUrl', function ($val) { $this->setUrlCancel($val); })
                ->setConditionByKey('returnUrl', function ($val) { $this->setUrlReturn($val); })
                ->setConditionByKey('currencyCode', function ($val) { $this->setCurrencyCode($val); })
                ->setConditionByKey('paymentInfoList', function ($val) { $this->setPaymentInfoList($val); })
                ->setConditionByKey('status', function ($val) { $this->setStatus($val); })
                ->setConditionByKey('payKey', function ($val) { $this->setPayKey($val); })
                ->setConditionByKey('actionType', function ($val) { $this->setActionType($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $actionType
         *
         * @return PaypalChargeVo
         */
        public function setActionType($actionType)
        {
            $this->_actionType = $actionType;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getActionType()
        {
            return (string)$this->_actionType;
        }

        // ######################################

        /**
         * @param mixed $currencyCode
         *
         * @return PaypalChargeVo
         */
        public function setCurrencyCode($currencyCode)
        {
            $this->_currencyCode = $currencyCode;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCurrencyCode()
        {
            return (string)$this->_currencyCode;
        }

        // ######################################

        /**
         * @param mixed $feesPayer
         *
         * @return PaypalChargeVo
         */
        public function setFeesPayer($feesPayer)
        {
            $this->_feesPayer = $feesPayer;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        public function getFeesPayer()
        {
            return (array)$this->_feesPayer;
        }

        // ######################################

        /**
         * @param mixed $payKey
         *
         * @return PaypalChargeVo
         */
        public function setPayKey($payKey)
        {
            $this->_payKey = $payKey;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getPayKey()
        {
            return (string)$this->_payKey;
        }

        // ######################################

        /**
         * @param mixed $paymentInfoList
         *
         * @return PaypalChargeVo
         */
        public function setPaymentInfoList($paymentInfoList)
        {
            $this->_paymentInfoList = $paymentInfoList;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        public function getPaymentInfoList()
        {
            return (array)$this->_paymentInfoList;
        }

        // ######################################

        /**
         * @return bool|PaypalChargePaymentInfoVo
         */
        public function getPaypalChargePaymentInfoVo()
        {
            $paymentInfoList = $this->getPaymentInfoList();

            if (is_array($paymentInfoList) && isset($paymentInfoList['paymentInfo']))
            {
                return (new PaypalChargePaymentInfoVo())->setData($paymentInfoList['paymentInfo']);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param mixed $responseEnvelope
         *
         * @return PaypalChargeVo
         */
        public function setResponseEnvelope($responseEnvelope)
        {
            $this->_responseEnvelope = $responseEnvelope;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        public function getResponseEnvelope()
        {
            return (array)$this->_responseEnvelope;
        }

        // ######################################

        /**
         * @param mixed $sender
         *
         * @return PaypalChargeVo
         */
        public function setSender($sender)
        {
            $this->_sender = $sender;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        public function getSender()
        {
            return (array)$this->_sender;
        }

        // ######################################

        /**
         * @param mixed $status
         *
         * @return PaypalChargeVo
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
         * @param mixed $urlCancel
         *
         * @return PaypalChargeVo
         */
        public function setUrlCancel($urlCancel)
        {
            $this->_urlCancel = $urlCancel;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlCancel()
        {
            return (string)$this->_urlCancel;
        }

        // ######################################

        /**
         * @param mixed $urlReturn
         *
         * @return PaypalChargeVo
         */
        public function setUrlReturn($urlReturn)
        {
            $this->_urlReturn = $urlReturn;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlReturn()
        {
            return (string)$this->_urlReturn;
        }
    }