<?php

    namespace Simplon\Payment\Vo;

    use Simplon\Payment\Iface\ChargeProductVoInterface;

    class ChargeProductVo implements ChargeProductVoInterface
    {
        protected $_referenceId;
        protected $_name;
        protected $_priceCents;
        protected $_priceVat;
        protected $_priceIncludesVat;
        protected $_surchargeCents;
        protected $_surchargeVat;
        protected $_surchargeIncludesVat;

        // ######################################

        /**
         * @param mixed $name
         *
         * @return ChargeProductVo
         */
        public function setName($name)
        {
            $this->_name = $name;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getName()
        {
            return (string)$this->_name;
        }

        // ######################################

        /**
         * @param mixed $priceCents
         *
         * @return ChargeProductVo
         */
        public function setPriceCents($priceCents)
        {
            $this->_priceCents = $priceCents;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getPriceCents()
        {
            return (int)$this->_priceCents;
        }

        // ######################################

        /**
         * @param mixed $priceVat
         *
         * @return ChargeProductVo
         */
        public function setPriceVat($priceVat)
        {
            $this->_priceVat = $priceVat;

            return $this;
        }

        // ######################################

        /**
         * @return float
         */
        public function getPriceVat()
        {
            return (float)$this->_priceVat;
        }

        // ######################################

        /**
         * @param bool $priceIncludesVat
         *
         * @return ChargeProductVo
         */
        public function setPriceIncludesVat($priceIncludesVat = TRUE)
        {
            $this->_priceIncludesVat = $priceIncludesVat !== FALSE ? TRUE : FALSE;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getPriceIncludesVat()
        {
            return (bool)$this->_priceIncludesVat;
        }

        // ######################################

        /**
         * @return int
         */
        public function getPriceVatCents()
        {
            $cents = $this->getPriceCents();
            $vat = $this->getPriceVat() / 100;

            if ($this->getPriceIncludesVat() === TRUE)
            {
                $priceWithoutVat = $cents / ($vat + 1);

                return (int)round($cents - $priceWithoutVat);
            }

            return (int)round($cents * $vat);
        }

        // ######################################

        /**
         * @return int
         */
        public function getTotalPriceCents()
        {
            if ($this->getPriceIncludesVat() === TRUE)
            {
                return $this->getPriceCents();
            }

            return $this->getPriceCents() + $this->getPriceVatCents();
        }

        // ######################################

        /**
         * @param mixed $referenceId
         *
         * @return ChargeProductVo
         */
        public function setReferenceId($referenceId)
        {
            $this->_referenceId = $referenceId;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getReferenceId()
        {
            return $this->_referenceId;
        }

        // ######################################

        /**
         * @param mixed $surchargeCents
         *
         * @return ChargeProductVo
         */
        public function setSurchargeCents($surchargeCents)
        {
            $this->_surchargeCents = $surchargeCents;

            return $this;
        }

        // ######################################

        /**
         * @return int
         */
        public function getSurchargeCents()
        {
            return (int)$this->_surchargeCents;
        }

        // ######################################

        /**
         * @param mixed $surchargeVat
         *
         * @return ChargeProductVo
         */
        public function setSurchargeVat($surchargeVat)
        {
            $this->_surchargeVat = $surchargeVat;

            return $this;
        }

        // ######################################

        /**
         * @return float
         */
        public function getSurchargeVat()
        {
            return (float)$this->_surchargeVat;
        }

        // ######################################

        /**
         * @param bool $surchargeIncludesVat
         *
         * @return ChargeProductVo
         */
        public function setSurchargeIncludesVat($surchargeIncludesVat = TRUE)
        {
            $this->_surchargeIncludesVat = $surchargeIncludesVat !== FALSE ? TRUE : FALSE;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getSurchargeIncludesVat()
        {
            return (bool)$this->_surchargeIncludesVat;
        }

        // ######################################

        /**
         * @return int
         */
        public function getSurchargeVatCents()
        {
            $cents = $this->getSurchargeCents();
            $vat = $this->getSurchargeVat() / 100;

            if ($this->getSurchargeIncludesVat() === TRUE)
            {
                $priceWithoutVat = $cents / ($vat + 1);

                return (int)round($cents - $priceWithoutVat);
            }

            return (int)round($cents * $vat);
        }

        // ######################################

        /**
         * @return int
         */
        public function getTotalSurchargeCents()
        {
            if ($this->getSurchargeIncludesVat() === TRUE)
            {
                return $this->getSurchargeCents();
            }

            return $this->getSurchargeCents() + $this->getSurchargeVatCents();
        }

        // ######################################

        /**
         * @return int
         */
        public function getTotalAmountCents()
        {
            return $this->getTotalPriceCents() + $this->getTotalSurchargeCents();
        }
    }