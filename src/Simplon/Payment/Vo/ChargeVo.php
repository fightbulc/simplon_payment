<?php

    namespace Simplon\Payment\Vo;

    use Simplon\Payment\Iface\ChargePayerVoInterface;
    use Simplon\Payment\Iface\ChargeProductVoInterface;
    use Simplon\Payment\Iface\ChargeVoInterface;

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
         * @return static
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
         * @return static
         */
        public function addChargeProductVo(ChargeProductVoInterface $chargeProductVo)
        {
            $this->_chargeProductVoMany[] = $chargeProductVo;

            return $this;
        }

        // ######################################

        /**
         * @param mixed $chargeProductVoMany
         *
         * @return static
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
         * @return int
         */
        public function getSubTotalAmountCents()
        {
            $subTotalAmountCents = 0;
            $chargeProductVoMany = $this->getChargeProductVoMany();

            foreach ($chargeProductVoMany as $chargeProductVo)
            {
                $subTotalAmountCents += $chargeProductVo->getSubTotalAmountCents();
            }

            return $subTotalAmountCents;
        }

        // ######################################

        /**
         * @return int
         */
        public function getTotalAmountCents()
        {
            $totalAmountCents = 0;
            $chargeProductVoMany = $this->getChargeProductVoMany();

            foreach ($chargeProductVoMany as $chargeProductVo)
            {
                $totalAmountCents += $chargeProductVo->getTotalAmountCents();
            }

            return $totalAmountCents;
        }

        // ######################################

        /**
         * @return int
         */
        public function getTotalVatAmountCents()
        {
            $totalVatAmountCents = 0;
            $chargeProductVoMany = $this->getChargeProductVoMany();

            foreach ($chargeProductVoMany as $chargeProductVo)
            {
                $totalVatAmountCents += $chargeProductVo->getTotalVatAmountCents();
            }

            return $totalVatAmountCents;
        }

        // ######################################

        /**
         * @param mixed $currency
         *
         * @return static
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
         * @return static
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
         * @return static
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