<?php

    namespace Simplon\Payment\PaySafeCard\Vo;

    class ProcessPaySafeCardVo
    {
        protected $_mid;
        protected $_username;
        protected $_password;
        protected $_mtid;
        protected $_subId;
        protected $_amount;
        protected $_currency;
        protected $_close;

        public function __construct(array $data)
        {
            $this->_mid = $data['mid'];
            $this->_username = $data['username'];
            $this->_password = $data['password'];
            $this->_mtid = $data['mtid'];
            $this->_subId = $data['subId'];
            $this->_amount = $data['amount'];
            $this->_currency = $data['currency'];
            $this->_close = $data['close'];
        }

        public function getAmount()
        {
            return $this->_amount;
        }

        public function getClose()
        {
            return $this->_close;
        }

        public function getCurrency()
        {
            return $this->_currency;
        }

        public function getMid()
        {
            return $this->_mid;
        }

        public function getMtid()
        {
            return $this->_mtid;
        }

        public function getPassword()
        {
            return $this->_password;
        }

        public function getSubId()
        {
            return $this->_subId;
        }

        public function getUsername()
        {
            return $this->_username;
        }


    }