<?php

    namespace Simplon\Payment\Traits;

    use Simplon\Payment\Iface\ChargeVoInterface;

    trait ChargeResponseVoTrait
    {
        protected $_chargeVo;
        protected $_transactionId;
        protected $_status;

        // ######################################

        /**
         * @param ChargeVoInterface $chargeVo
         *
         * @return static
         */
        public function setChargeVo(ChargeVoInterface $chargeVo)
        {
            $this->_chargeVo = $chargeVo;

            return $this;
        }

        // ######################################

        /**
         * @param mixed $status
         *
         * @return static
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
         * @return static
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