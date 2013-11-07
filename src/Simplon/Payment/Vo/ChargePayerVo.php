<?php

    namespace Simplon\Payment\Vo;

    use Simplon\Payment\Iface\ChargePayerVoInterface;

    class ChargePayerVo implements ChargePayerVoInterface
    {
        protected $_isNewPayer = FALSE;
        protected $_providerId;
        protected $_isNewMean = FALSE;
        protected $_providerMeanId;
        protected $_name;
        protected $_email;

        // ######################################

        /**
         * @param mixed $email
         *
         * @return ChargePayerVo
         */
        public function setEmail($email)
        {
            $this->_email = $email;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getEmail()
        {
            return (string)$this->_email;
        }

        // ######################################

        /**
         * @param mixed $name
         *
         * @return ChargePayerVo
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
         * @param mixed $providerId
         *
         * @return ChargePayerVo
         */
        public function setProviderId($providerId)
        {
            $this->_providerId = $providerId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getProviderId()
        {
            return (string)$this->_providerId;
        }

        // ######################################

        /**
         * @param bool $isNew
         *
         * @return $this
         */
        public function setIsNewPayer($isNew = TRUE)
        {
            $this->_isNewPayer = $isNew;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function isNewPayer()
        {
            return $this->_isNewPayer !== FALSE ? TRUE : FALSE;
        }

        // ######################################

        /**
         * @param mixed $providerMeanId
         *
         * @return ChargePayerVo
         */
        public function setProviderMeanId($providerMeanId)
        {
            $this->_providerMeanId = $providerMeanId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getProviderMeanId()
        {
            return (string)$this->_providerMeanId;
        }

        // ######################################

        /**
         * @param bool $isNew
         *
         * @return $this
         */
        public function setIsNewMean($isNew = TRUE)
        {
            $this->_isNewPayer = $isNew;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function isNewMean()
        {
            return $this->_isNewMean !== FALSE ? TRUE : FALSE;
        }
    }