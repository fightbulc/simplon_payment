<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class StripeCardVo
    {
        protected $_id;
        protected $_object;
        protected $_last4;
        protected $_type;
        protected $_expMonth;
        protected $_expYear;
        protected $_fingerPrint;
        protected $_customer;
        protected $_country;
        protected $_cardHolderName;
        protected $_addressLine1;
        protected $_addressLine1Check;
        protected $_addressLine2;
        protected $_addressCity;
        protected $_addressState;
        protected $_addressZip;
        protected $_addressZipCheck;
        protected $_addressCountry;
        protected $_cvcCheck;

        // ######################################

        /**
         * @param array $data
         *
         * @return StripeCardVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('id', function ($val) { $this->setId($val); })
                ->setConditionByKey('object', function ($val) { $this->setObject($val); })
                ->setConditionByKey('last4', function ($val) { $this->setLast4($val); })
                ->setConditionByKey('type', function ($val) { $this->setType($val); })
                ->setConditionByKey('exp_month', function ($val) { $this->setExpMonth($val); })
                ->setConditionByKey('exp_year', function ($val) { $this->setExpYear($val); })
                ->setConditionByKey('fingerprint', function ($val) { $this->setFingerPrint($val); })
                ->setConditionByKey('customer', function ($val) { $this->setCustomer($val); })
                ->setConditionByKey('country', function ($val) { $this->setCountry($val); })
                ->setConditionByKey('name', function ($val) { $this->setCardHolderName($val); })
                ->setConditionByKey('address_line1', function ($val) { $this->setAddressLine1($val); })
                ->setConditionByKey('address_line1_check', function ($val) { $this->setAddressLine1Check($val); })
                ->setConditionByKey('address_line2', function ($val) { $this->setAddressLine2($val); })
                ->setConditionByKey('address_city', function ($val) { $this->setAddressCity($val); })
                ->setConditionByKey('address_state', function ($val) { $this->setAddressState($val); })
                ->setConditionByKey('address_zip', function ($val) { $this->setAddressZip($val); })
                ->setConditionByKey('address_zip_check', function ($val) { $this->setAddressZipCheck($val); })
                ->setConditionByKey('address_country', function ($val) { $this->setAddressCountry($val); })
                ->setConditionByKey('cvc_check', function ($val) { $this->setCvcCheck($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $addressCity
         *
         * @return StripeCardVo
         */
        public function setAddressCity($addressCity)
        {
            $this->_addressCity = $addressCity;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAddressCity()
        {
            return $this->_addressCity;
        }

        // ######################################

        /**
         * @param mixed $addressCountry
         *
         * @return StripeCardVo
         */
        public function setAddressCountry($addressCountry)
        {
            $this->_addressCountry = $addressCountry;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAddressCountry()
        {
            return $this->_addressCountry;
        }

        // ######################################

        /**
         * @param mixed $addressLine1
         *
         * @return StripeCardVo
         */
        public function setAddressLine1($addressLine1)
        {
            $this->_addressLine1 = $addressLine1;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAddressLine1()
        {
            return $this->_addressLine1;
        }

        // ######################################

        /**
         * @param mixed $addressLine1Check
         *
         * @return StripeCardVo
         */
        public function setAddressLine1Check($addressLine1Check)
        {
            $this->_addressLine1Check = $addressLine1Check;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAddressLine1Check()
        {
            return $this->_addressLine1Check;
        }

        // ######################################

        /**
         * @param mixed $addressLine2
         *
         * @return StripeCardVo
         */
        public function setAddressLine2($addressLine2)
        {
            $this->_addressLine2 = $addressLine2;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAddressLine2()
        {
            return $this->_addressLine2;
        }

        // ######################################

        /**
         * @param mixed $addressState
         *
         * @return StripeCardVo
         */
        public function setAddressState($addressState)
        {
            $this->_addressState = $addressState;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAddressState()
        {
            return $this->_addressState;
        }

        // ######################################

        /**
         * @param mixed $addressZip
         *
         * @return StripeCardVo
         */
        public function setAddressZip($addressZip)
        {
            $this->_addressZip = $addressZip;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAddressZip()
        {
            return $this->_addressZip;
        }

        // ######################################

        /**
         * @param mixed $addressZipCheck
         *
         * @return StripeCardVo
         */
        public function setAddressZipCheck($addressZipCheck)
        {
            $this->_addressZipCheck = $addressZipCheck;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAddressZipCheck()
        {
            return $this->_addressZipCheck;
        }

        // ######################################

        /**
         * @param mixed $country
         *
         * @return StripeCardVo
         */
        public function setCountry($country)
        {
            $this->_country = $country;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCountry()
        {
            return $this->_country;
        }

        // ######################################

        /**
         * @param mixed $customer
         *
         * @return StripeCardVo
         */
        public function setCustomer($customer)
        {
            $this->_customer = $customer;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCustomer()
        {
            return $this->_customer;
        }

        // ######################################

        /**
         * @param mixed $cvcCheck
         *
         * @return StripeCardVo
         */
        public function setCvcCheck($cvcCheck)
        {
            $this->_cvcCheck = $cvcCheck;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCvcCheck()
        {
            return $this->_cvcCheck;
        }

        // ######################################

        /**
         * @param mixed $expMonth
         *
         * @return StripeCardVo
         */
        public function setExpMonth($expMonth)
        {
            $this->_expMonth = $expMonth;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getExpMonth()
        {
            return $this->_expMonth;
        }

        // ######################################

        /**
         * @param mixed $expYear
         *
         * @return StripeCardVo
         */
        public function setExpYear($expYear)
        {
            $this->_expYear = $expYear;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getExpYear()
        {
            return $this->_expYear;
        }

        // ######################################

        /**
         * @param mixed $fingerPrint
         *
         * @return StripeCardVo
         */
        public function setFingerPrint($fingerPrint)
        {
            $this->_fingerPrint = $fingerPrint;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getFingerPrint()
        {
            return $this->_fingerPrint;
        }

        // ######################################

        /**
         * @param mixed $id
         *
         * @return StripeCardVo
         */
        public function setId($id)
        {
            $this->_id = $id;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->_id;
        }

        // ######################################

        /**
         * @param mixed $last4
         *
         * @return StripeCardVo
         */
        public function setLast4($last4)
        {
            $this->_last4 = $last4;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getLast4()
        {
            return $this->_last4;
        }

        // ######################################

        /**
         * @param mixed $name
         *
         * @return StripeCardVo
         */
        public function setCardHolderName($name)
        {
            $this->_cardHolderName = $name;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCardHolderName()
        {
            return $this->_cardHolderName;
        }

        // ######################################

        /**
         * @param mixed $object
         *
         * @return StripeCardVo
         */
        public function setObject($object)
        {
            $this->_object = $object;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getObject()
        {
            return $this->_object;
        }

        // ######################################

        /**
         * @param mixed $type
         *
         * @return StripeCardVo
         */
        public function setType($type)
        {
            $this->_type = $type;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getType()
        {
            return $this->_type;
        }
    }