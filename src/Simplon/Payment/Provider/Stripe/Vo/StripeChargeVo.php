<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class StripeChargeVo
    {
        protected $_id;
        protected $_object;
        protected $_created;
        protected $_liveMode;
        protected $_paid;
        protected $_amountCents;
        protected $_currency;
        protected $_refunded;
        protected $_card;
        protected $_captured;
        protected $_refunds;
        protected $_balanceTransaction;
        protected $_failureMessage;
        protected $_failureCode;
        protected $_amountRefunded;
        protected $_customer;
        protected $_invoice;
        protected $_description;
        protected $_dispute;
        protected $_metaData;

        /** @var  StripeCardVo */
        protected $_stripeCardVo;

        // ######################################

        /**
         * @param array $data
         *
         * @return StripeChargeVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('id', function ($val) { $this->setId($val); })
                ->setConditionByKey('object', function ($val) { $this->setObject($val); })
                ->setConditionByKey('created', function ($val) { $this->setCreated($val); })
                ->setConditionByKey('livemode', function ($val) { $this->setLiveMode($val); })
                ->setConditionByKey('paid', function ($val) { $this->setPaid($val); })
                ->setConditionByKey('amount', function ($val) { $this->setAmountCents($val); })
                ->setConditionByKey('currency', function ($val) { $this->setCurrency($val); })
                ->setConditionByKey('refunded', function ($val) { $this->setRefunded($val); })
                ->setConditionByKey('card', function ($val) { $this->setCard($val); })
                ->setConditionByKey('captured', function ($val) { $this->setCaptured($val); })
                ->setConditionByKey('refunds', function ($val) { $this->setRefunds($val); })
                ->setConditionByKey('balance_transaction', function ($val) { $this->setBalanceTransaction($val); })
                ->setConditionByKey('failure_message', function ($val) { $this->setFailureMessage($val); })
                ->setConditionByKey('failure_code', function ($val) { $this->setFailureCode($val); })
                ->setConditionByKey('amount_refunded', function ($val) { $this->setAmountRefunded($val); })
                ->setConditionByKey('customer', function ($val) { $this->setCustomer($val); })
                ->setConditionByKey('invoice', function ($val) { $this->setInvoice($val); })
                ->setConditionByKey('description', function ($val) { $this->setDescription($val); })
                ->setConditionByKey('dispute', function ($val) { $this->setDispute($val); })
                ->setConditionByKey('metadata', function ($val) { $this->setMetaData($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $amountCents
         *
         * @return StripeChargeVo
         */
        public function setAmountCents($amountCents)
        {
            $this->_amountCents = $amountCents;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAmountCents()
        {
            return $this->_amountCents;
        }

        // ######################################

        /**
         * @param mixed $amountRefunded
         *
         * @return StripeChargeVo
         */
        public function setAmountRefunded($amountRefunded)
        {
            $this->_amountRefunded = $amountRefunded;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAmountRefunded()
        {
            return $this->_amountRefunded;
        }

        // ######################################

        /**
         * @param mixed $balanceTransaction
         *
         * @return StripeChargeVo
         */
        public function setBalanceTransaction($balanceTransaction)
        {
            $this->_balanceTransaction = $balanceTransaction;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getBalanceTransaction()
        {
            return $this->_balanceTransaction;
        }

        // ######################################

        /**
         * @param mixed $captured
         *
         * @return StripeChargeVo
         */
        public function setCaptured($captured)
        {
            $this->_captured = $captured;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getCaptured()
        {
            return $this->_captured === TRUE ? TRUE : FALSE;
        }

        // ######################################

        /**
         * @param mixed $card
         *
         * @return StripeChargeVo
         */
        public function setCard($card)
        {
            $this->_card = $card;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCard()
        {
            return $this->_card;
        }

        // ######################################

        /**
         * @param mixed $created
         *
         * @return StripeChargeVo
         */
        public function setCreated($created)
        {
            $this->_created = $created;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCreated()
        {
            return $this->_created;
        }

        // ######################################

        /**
         * @param mixed $currency
         *
         * @return StripeChargeVo
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
         * @param mixed $customer
         *
         * @return StripeChargeVo
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
         * @param mixed $description
         *
         * @return StripeChargeVo
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
         * @param mixed $dispute
         *
         * @return StripeChargeVo
         */
        public function setDispute($dispute)
        {
            $this->_dispute = $dispute;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getDispute()
        {
            return $this->_dispute;
        }

        // ######################################

        /**
         * @param mixed $failureCode
         *
         * @return StripeChargeVo
         */
        public function setFailureCode($failureCode)
        {
            $this->_failureCode = $failureCode;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getFailureCode()
        {
            return $this->_failureCode;
        }

        // ######################################

        /**
         * @param mixed $failureMessage
         *
         * @return StripeChargeVo
         */
        public function setFailureMessage($failureMessage)
        {
            $this->_failureMessage = $failureMessage;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getFailureMessage()
        {
            return $this->_failureMessage;
        }

        // ######################################

        /**
         * @param mixed $id
         *
         * @return StripeChargeVo
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
         * @param mixed $invoice
         *
         * @return StripeChargeVo
         */
        public function setInvoice($invoice)
        {
            $this->_invoice = $invoice;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getInvoice()
        {
            return $this->_invoice;
        }

        // ######################################

        /**
         * @param mixed $liveMode
         *
         * @return StripeChargeVo
         */
        public function setLiveMode($liveMode)
        {
            $this->_liveMode = $liveMode;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getLiveMode()
        {
            return $this->_liveMode === TRUE ? TRUE : FALSE;
        }

        // ######################################

        /**
         * @param mixed $metaData
         *
         * @return StripeChargeVo
         */
        public function setMetaData($metaData)
        {
            $this->_metaData = $metaData;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getMetaData()
        {
            return $this->_metaData;
        }

        // ######################################

        /**
         * @param mixed $object
         *
         * @return StripeChargeVo
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
         * @param mixed $paid
         *
         * @return StripeChargeVo
         */
        public function setPaid($paid)
        {
            $this->_paid = $paid;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getPaid()
        {
            return $this->_paid === TRUE ? TRUE : FALSE;
        }

        // ######################################

        /**
         * @param mixed $refunded
         *
         * @return StripeChargeVo
         */
        public function setRefunded($refunded)
        {
            $this->_refunded = $refunded;

            return $this;
        }

        // ######################################

        /**
         * @return bool
         */
        public function getRefunded()
        {
            return $this->_refunded === TRUE ? TRUE : FALSE;
        }

        // ######################################

        /**
         * @param mixed $refunds
         *
         * @return StripeChargeVo
         */
        public function setRefunds($refunds)
        {
            $this->_refunds = $refunds;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getRefunds()
        {
            return $this->_refunds;
        }

        // ######################################

        /**
         * @param StripeCardVo $stripeCardVo
         *
         * @return StripeChargeVo
         */
        public function setStripeCardVo(StripeCardVo $stripeCardVo)
        {
            $this->_stripeCardVo = $stripeCardVo;

            return $this;
        }

        // ######################################

        /**
         * @return StripeCardVo
         */
        public function getStripeCardVo()
        {
            if (!$this->_stripeCardVo)
            {
                $this->_stripeCardVo = (new StripeCardVo())->setData($this->getCard());
            }

            return $this->_stripeCardVo;
        }
    }