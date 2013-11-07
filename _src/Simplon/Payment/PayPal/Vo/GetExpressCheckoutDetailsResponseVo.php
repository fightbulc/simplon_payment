<?php

    namespace Simplon\Payment\PayPal\Vo;

    class GetExpressCheckoutDetailsResponseVo extends AbstractVo
    {
        /**
         * @return bool|mixed
         */
        public function getEmail()
        {
            return $this->_getByKey('email');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getPayerId()
        {
            return $this->_getByKey('payerid');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getPayerStatus()
        {
            return $this->_getByKey('payerstatus');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getFirstName()
        {
            return $this->_getByKey('firstname');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getLastName()
        {
            return $this->_getByKey('lastname');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getCurrencyCode()
        {
            return $this->_getByKey('currencycode');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getOrderAmount()
        {
            return $this->_getByKey('amt');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getOrderItemsAmount()
        {
            return $this->_getByKey('itemamt');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getOrderTaxAmount()
        {
            return $this->_getByKey('taxamt');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getCountryCode()
        {
            return $this->_getByKey('countrycode');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getBusiness()
        {
            return $this->_getByKey('business');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getShipToName()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_SHIPTONAME');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getShipToStreet()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOSTREET');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getShipToCity()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOCITY');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getShipToState()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOSTATE');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getShipToCountryCode()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getShipToCountryName()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getShipToZip()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOZIP');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getAddressId()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_ADDRESSID');
        }

        // ##########################################

        /**
         * @return bool|mixed
         */
        public function getAddressStatus()
        {
            return $this->_getByKey('PAYMENTREQUEST_0_ADDRESSSTATUS');
        }
    }
