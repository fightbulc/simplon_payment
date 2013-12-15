<?php

    namespace Simplon\Payment\Provider\IcePayIdeal\Vo;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Traits\ChargeVoTrait;

    class ChargeVo implements ChargeVoInterface
    {
        use ChargeVoTrait;

        protected $_issuer;
        protected $_countryCode;
        protected $_languageCode;
        protected $_urlApproval;

        // ######################################

        /**
         * @param mixed $urlApproval
         *
         * @return ChargeVo
         */
        public function setUrlApproval($urlApproval)
        {
            $this->_urlApproval = $urlApproval;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlApproval()
        {
            return (string)$this->_urlApproval;
        }

        // ######################################

        /**
         * @param mixed $country
         *
         * @return ChargeVo
         */
        public function setCountryCode($country)
        {
            $this->_countryCode = $country;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCountryCode()
        {
            return strtoupper($this->_countryCode);
        }

        // ######################################

        /**
         * @param mixed $issuer
         *
         * @return ChargeVo
         */
        public function setIssuer($issuer)
        {
            $this->_issuer = $issuer;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getIssuer()
        {
            return strtoupper($this->_issuer);
        }

        // ######################################

        /**
         * @param mixed $language
         *
         * @return ChargeVo
         */
        public function setLanguageCode($language)
        {
            $this->_languageCode = $language;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getLanguageCode()
        {
            return strtoupper($this->_languageCode);
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
         * @return ChargeProductVo[]
         */
        public function getChargeProductVoMany()
        {
            return $this->_chargeProductVoMany;
        }
    }