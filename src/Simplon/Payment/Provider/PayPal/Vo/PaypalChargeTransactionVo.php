<?php

    namespace Simplon\Payment\Provider\Paypal\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class PaypalChargeTransactionVo
    {
        protected $_total;
        protected $_currency;
        protected $_description;
        protected $_details;

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalChargeVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data['amount'])
                ->setConditionByKey('total', function ($val) { $this->setTotal($val); })
                ->setConditionByKey('currency', function ($val) { $this->setCurrency($val); })
                ->setConditionByKey('description', function ($val) { $this->setDescription($val); })
                ->setConditionByKey('details', function ($val) { $this->setDetails($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $currency
         *
         * @return PaypalChargeTransactionVo
         */
        public function setCurrency($currency)
        {
            $this->_currency = $currency;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCurrency()
        {
            return $this->_currency;
        }

        // ######################################

        /**
         * @param mixed $description
         *
         * @return PaypalChargeTransactionVo
         */
        public function setDescription($description)
        {
            $this->_description = $description;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->_description;
        }

        // ######################################

        /**
         * @param mixed $details
         *
         * @return PaypalChargeTransactionVo
         */
        public function setDetails($details)
        {
            $this->_details = $details;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getDetails()
        {
            return $this->_details;
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getDetailsSubtotal()
        {
            if (isset($this->_details['subtotal']))
            {
                return (string)$this->_details['subtotal'];
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getDetailsTax()
        {
            if (isset($this->_details['tax']))
            {
                return (string)$this->_details['tax'];
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getDetailsFee()
        {
            if (isset($this->_details['fee']))
            {
                return (string)$this->_details['fee'];
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param mixed $totalAmount
         *
         * @return PaypalChargeTransactionVo
         */
        public function setTotal($totalAmount)
        {
            $this->_total = $totalAmount;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getTotal()
        {
            return $this->_total;
        }
    }