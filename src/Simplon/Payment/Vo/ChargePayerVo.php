<?php

    namespace Simplon\Payment\Vo;

    use Simplon\Payment\Iface\ChargePayerVoCustomDataInterface;
    use Simplon\Payment\Iface\ChargePayerVoInterface;

    class ChargePayerVo implements ChargePayerVoInterface
    {
        protected $_name;
        protected $_email;

        /** @var  ChargePayerVoCustomDataInterface */
        protected $_customDataVo;

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
         * @param ChargePayerVoCustomDataInterface $customDataVo
         *
         * @return static
         */
        public function setCustomDataVo(ChargePayerVoCustomDataInterface $customDataVo)
        {
            $this->_customDataVo = $customDataVo;

            return $this;
        }

        // ######################################

        /**
         * @return ChargePayerVoCustomDataInterface
         */
        public function getCustomDataVo()
        {
            return $this->_customDataVo;
        }
    }