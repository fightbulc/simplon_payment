<?php

    namespace Simplon\Payment\PaySafeCard\Vo;

    class CheckoutPaySafeCardVo
    {

        protected $_mid;

        protected $_username;
        protected $_password;
        protected $_mtid;
        protected $_subId;
        protected $_amount;
        protected $_currency;

        protected $_merchantclientId;
        protected $_pnUrl;

        protected $_clientIp;
        protected $_okUrl;
        protected $_nokUrl;

        public function __construct(array $data)
        {
            $this->_mid = $data['mid'];

            $this->_username = $data['username'];
            $this->_password = $data['password'];
            $this->_mtid = $data['mtid'];
            $this->_subId = $data['subId'];
            $this->_amount = $data['amount'];
            $this->_currency = $data['currency'];

            $this->_merchantclientId = $data['merchantclientId'];
            $this->_pnUrl = $data['pnUrl'];

            $this->_clientIp = $data['clientIp'];
            $this->_okUrl = $data['okUrl'];
            $this->_nokUrl = $data['nokUrl'];

        }

        /**
         * @return mixed
         */
        public function getMid()
        {
            return $this->_mid;
        }

        /**
         * @return mixed
         */
        public function getPassword()
        {
            return $this->_password;
        }

        /**
         * @return mixed
         */
        public function getUsername()
        {
            return $this->_username;
        }

        /**
         * @return mixed
         */
        public function getAmount()
        {
            return $this->_amount;
        }

        /**
         * @return mixed
         */
        public function getCurrency()
        {
            return $this->_currency;
        }

        /**
         * @return mixed
         */
        public function getMtid()
        {
            return $this->_mtid;
        }

        /**
         * @return mixed
         */
        public function getSubId()
        {
            return $this->_subId;
        }

        /**
         * @return mixed
         */
        public function getNokUrl()
        {
            return $this->_nokUrl;
        }

        /**
         * @return mixed
         */
        public function getOkUrl()
        {
            return $this->_okUrl;
        }

        /**
         * @return mixed
         */
        public function getClientIp()
        {
            return $this->_clientIp;
        }

        /**
         * @return mixed
         */
        public function getMerchantclientId()
        {
            return $this->_merchantclientId;
        }

        /**
         * @return mixed
         */
        public function getPnUrl()
        {
            return $this->_pnUrl;
        }

    }