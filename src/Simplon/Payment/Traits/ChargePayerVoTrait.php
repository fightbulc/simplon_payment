<?php

    namespace Simplon\Payment\Traits;

    trait ChargePayerVoTrait
    {
        protected $_name;
        protected $_email;

        // ######################################

        /**
         * @param mixed $email
         *
         * @return static
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
         * @return static
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