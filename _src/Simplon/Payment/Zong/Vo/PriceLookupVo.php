<?php

    namespace Simplon\Payment\Zong\Vo;

    class PriceLookupVo
    {
        protected $_countryCode;
        protected $_currecyCode;

        #########################################

        public function __construct(array $data)
        {
            $this->_countryCode = $data['countryCode'];
            $this->_currecyCode = $data['currecyCode'];
        }

        #########################################

        public function getCountryCode()
        {
            return $this->_countryCode;
        }

        #########################################

        public function getCurrecyCode()
        {
            return $this->_currecyCode;
        }

    }