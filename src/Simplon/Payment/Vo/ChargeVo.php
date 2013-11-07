<?php

    namespace Simplon\Payment\Vo;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Iface\ChargePayerVoInterface;
    use Simplon\Payment\Iface\ChargeProductVoInterface;

    class ChargeVo implements ChargeVoInterface
    {
        protected $_referenceId;
        protected $_description;
        protected $_currency;

        /** @var  ChargePayerVo */
        protected $_chargePayerVo;

        /** @var  ChargeProductVo[] */
        protected $_chargeProductVoMany;

        // ######################################

        /**
         * @param ChargePayerVoInterface $chargePayerVo
         *
         * @return ChargeVo
         */
        public function setChargePayerVo(ChargePayerVoInterface $chargePayerVo)
        {
            $this->_chargePayerVo = $chargePayerVo;

            return $this;
        }

        // ######################################

        /**
         * @return ChargePayerVo
         */
        public function getChargePayerVo()
        {
            return $this->_chargePayerVo;
        }

        // ######################################

        /**
         * @param ChargeProductVoInterface $chargeProductVo
         *
         * @return ChargeVo
         */
        public function setChargeProductVo(ChargeProductVoInterface $chargeProductVo)
        {
            $this->_chargeProductVoMany[] = $chargeProductVo;

            return $this;
        }

        // ######################################

        /**
         * @param mixed $chargeProductVoMany
         *
         * @return ChargeVo
         */
        public function setChargeProductVoMany(array $chargeProductVoMany)
        {
            $this->_chargeProductVoMany = $chargeProductVoMany;

            return $this;
        }

        // ######################################

        /**
         * @return ChargeProductVo[]
         */
        public function getChargeProductVoMany()
        {
            return $this->_chargeProductVoMany;
        }

        // ######################################

        /**
         * @param mixed $currency
         *
         * @return ChargeVo
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
         * @param mixed $description
         *
         * @return ChargeVo
         */
        public function setDescription($description)
        {
            $this->_description = $description;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getDescription()
        {
            return (string)$this->_description;
        }

        // ######################################

        /**
         * @param mixed $referenceId
         *
         * @return ChargeVo
         */
        public function setReferenceId($referenceId)
        {
            $this->_referenceId = $referenceId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getReferenceId()
        {
            return (string)$this->_referenceId;
        }
    }