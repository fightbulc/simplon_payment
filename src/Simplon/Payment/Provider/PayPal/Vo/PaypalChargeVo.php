<?php

    namespace Simplon\Payment\Provider\Paypal\Vo;

    use Simplon\Helper\VoManyFactory;
    use Simplon\Helper\VoSetDataFactory;

    class PaypalChargeVo
    {
        protected $_id;
        protected $_createTime;
        protected $_updateTime;
        protected $_state;
        protected $_intent;
        protected $_payer;
        protected $_transactions;
        protected $_links;

        /** @var  PaypalPayerVo */
        protected $_paypalPayerVo;

        /** @var  PaypalChargeTransactionVo[] */
        protected $_paypalChargeTransactionVoMany;

        /** @var  PaypalChargeLinksVo */
        protected $_paypalChargeLinksVo;

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalChargeVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('id', function ($val) { $this->setId($val); })
                ->setConditionByKey('create_time', function ($val) { $this->setCreateTime($val); })
                ->setConditionByKey('update_time', function ($val) { $this->setUpdateTime($val); })
                ->setConditionByKey('state', function ($val) { $this->setState($val); })
                ->setConditionByKey('intent', function ($val) { $this->setIntent($val); })
                ->setConditionByKey('payer', function ($val) { $this->setPayer($val); })
                ->setConditionByKey('transactions', function ($val) { $this->setTransactions($val); })
                ->setConditionByKey('links', function ($val) { $this->setLinks($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $createdTime
         *
         * @return PaypalChargeVo
         */
        public function setCreateTime($createdTime)
        {
            $this->_createTime = $createdTime;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCreateTime()
        {
            return $this->_createTime;
        }

        // ######################################

        /**
         * @param mixed $id
         *
         * @return PaypalChargeVo
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
         * @param mixed $intent
         *
         * @return PaypalChargeVo
         */
        public function setIntent($intent)
        {
            $this->_intent = $intent;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getIntent()
        {
            return $this->_intent;
        }

        // ######################################

        /**
         * @param mixed $links
         *
         * @return PaypalChargeVo
         */
        public function setLinks($links)
        {
            $this->_links = $links;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getLinks()
        {
            return $this->_links;
        }

        // ######################################

        /**
         * @return PaypalChargeLinksVo
         */
        public function getPaypalChargeLinksVo()
        {
            if (!$this->_paypalChargeLinksVo)
            {
                $this->_paypalChargeLinksVo = (new PaypalChargeLinksVo())->setData($this->getLinks());
            }

            return $this->_paypalChargeLinksVo;
        }

        // ######################################

        /**
         * @param mixed $payer
         *
         * @return PaypalChargeVo
         */
        public function setPayer($payer)
        {
            $this->_payer = $payer;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getPayer()
        {
            return $this->_payer;
        }

        // ######################################

        /**
         * @param mixed $state
         *
         * @return PaypalChargeVo
         */
        public function setState($state)
        {
            $this->_state = $state;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getState()
        {
            return $this->_state;
        }

        // ######################################

        /**
         * @param mixed $transactions
         *
         * @return PaypalChargeVo
         */
        public function setTransactions($transactions)
        {
            $this->_transactions = $transactions;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getTransactions()
        {
            return $this->_transactions;
        }

        // ######################################

        /**
         * @return PaypalChargeTransactionVo[]
         */
        public function getPaypalChargeTransactionVoMany()
        {
            if (!$this->_paypalChargeTransactionVoMany)
            {
                $transactions = $this->getTransactions();

                $this->_paypalChargeTransactionVoMany = VoManyFactory::factory($transactions, function ($key, $val)
                {
                    return (new PaypalChargeTransactionVo())->setData($val);
                });
            }

            return $this->_paypalChargeTransactionVoMany;
        }

        // ######################################

        /**
         * @param mixed $updateTime
         *
         * @return PaypalChargeVo
         */
        public function setUpdateTime($updateTime)
        {
            $this->_updateTime = $updateTime;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getUpdateTime()
        {
            return $this->_updateTime;
        }
    }