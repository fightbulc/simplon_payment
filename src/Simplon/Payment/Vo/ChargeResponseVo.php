<?php

    namespace Simplon\Payment\Vo;

    use Simplon\Payment\Iface\ChargeResponseVoInterface;

    class ChargeResponseVo extends ChargeVo implements ChargeResponseVoInterface
    {
        protected $_transactionId;
        protected $_response;
        protected $_status;

        // ######################################

        /**
         * @param mixed $response
         *
         * @return ChargeResponseVo
         */
        public function setResponse($response)
        {
            $this->_response = $response;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getResponse()
        {
            return (string)$this->_response;
        }

        // ######################################

        /**
         * @param mixed $status
         *
         * @return ChargeResponseVo
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
         * @param mixed $transactionId
         *
         * @return ChargeResponseVo
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