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
        protected $_endPoint;

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
            $this->_endPoint = $data['endPoint'];
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
        public function getClose()
        {
            return $this->_close;
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
        public function getMid()
        {
            return $this->_mid;
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
        public function getPassword()
        {
            return $this->_password;
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
        public function getUsername()
        {
            return $this->_username;
        }

        /**
         * @return mixed
         */
        public function getEndPoint()
        {
            return $this->_endPoint;
        }


    }