<?php

    namespace Simplon\Payment\PaySafeCard\Vo;

    class CheckoutPaySafeCardVo
    {

        protected $_mid;
        protected $_username;
        protected $_password;
        protected $_amount;
        protected $_currency;
        protected $_mtid;
        protected $_gameServerId;
        protected $_okUrl;
        protected $_nokUrl;

        public function __construct(array $data)
        {
            $this->_mid = $data['mid'];
            $this->_username = $data['username'];
            $this->_password = $data['password'];
            $this->_amount = $data['amount'];
            $this->_currency = $data['currency'];
            $this->_mtid = $data['mtid'];
            $this->_gameServerId = $data['gameServerId'];
            $this->_okUrl = $data['okUrl'];
            $this->_nokUrl = $data['nokUrl'];

        }

        public function getMid()
        {
            return $this->_mid;
        }

        public function getPassword()
        {
            return $this->_password;
        }

        public function getUsername()
        {
            return $this->_username;
        }

        public function getAmount()
        {
            return $this->_amount;
        }

        public function getCurrency()
        {
            return $this->_currency;
        }

        public function getMtid()
        {
            return $this->_mtid;
        }

        public function getGameServerId()
        {
            return $this->_gameServerId;
        }

        public function getNokUrl()
        {
            return $this->_nokUrl;
        }

        public function getOkUrl()
        {
            return $this->_okUrl;
        }


    }