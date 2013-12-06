<?php

    namespace Simplon\Payment\Vo;

    use Simplon\Payment\Iface\ChargePayerVoInterface;

    class ChargePayerVo implements ChargePayerVoInterface
    {
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
    }