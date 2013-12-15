<?php

    namespace Simplon\Payment\Provider\IcepayIdeal\Vo;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Traits\ChargeVoTrait;

    class ChargeVo implements ChargeVoInterface
    {
        use ChargeVoTrait;

        protected $_issuer;
        protected $_countryCode;
        protected $_languageCode;
        protected $_urlSuccess;
        protected $_urlError;

        // ######################################

        /**
         * @param mixed $urlError
         *
         * @return ChargeVo
         */
        public function setUrlError($urlError)
        {
            $this->_urlError = $urlError;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlError()
        {
            return (string)$this->_urlError;
        }

        // ######################################

        /**
         * @param mixed $urlSuccess
         *
         * @return ChargeVo
         */
        public function setUrlSuccess($urlSuccess)
        {
            $this->_urlSuccess = $urlSuccess;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUrlSuccess()
        {
            return (string)$this->_urlSuccess;
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