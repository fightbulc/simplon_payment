<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class PaypalSaleVo
    {
        protected $_id;
        protected $_createTime;
        protected $_updateTime;
        protected $_state;
        protected $_amount;
        protected $_parentPaymentId;
        protected $_links;

        /** @var  PaypalSaleLinksVo */
        protected $_paypalSaleLinksVo;

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalSaleVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('id', function ($val) { $this->setId($val); })
                ->setConditionByKey('create_time', function ($val) { $this->setCreateTime($val); })
                ->setConditionByKey('update_time', function ($val) { $this->setUpdateTime($val); })
                ->setConditionByKey('state', function ($val) { $this->setState($val); })
                ->setConditionByKey('amount', function ($val) { $this->setAmount($val); })
                ->setConditionByKey('parent_payment', function ($val) { $this->setParentPaymentId($val); })
                ->setConditionByKey('links', function ($val) { $this->setLinks($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param array $amount
         *
         * @return PaypalSaleVo
         */
        public function setAmount(array $amount)
        {
            $this->_amount = $amount;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        protected function _getAmount()
        {
            return (array)$this->_amount;
        }

        // ######################################

        /**
         * @return bool|int
         */
        public function getTotalAmountCents()
        {
            $amount = $this->_getAmount();

            if ($amount)
            {
                return (int)($amount['total'] * 100);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getCurrency()
        {
            $amount = $this->_getAmount();

            if ($amount)
            {
                return (string)$amount['currency'];
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param mixed $createTime
         *
         * @return PaypalSaleVo
         */
        public function setCreateTime($createTime)
        {
            $this->_createTime = $createTime;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getCreateTime()
        {
            return (string)$this->_createTime;
        }

        // ######################################

        /**
         * @param mixed $id
         *
         * @return PaypalSaleVo
         */
        public function setId($id)
        {
            $this->_id = $id;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getId()
        {
            return (string)$this->_id;
        }

        // ######################################

        /**
         * @param array $links
         *
         * @return PaypalSaleVo
         */
        public function setLinks(array $links)
        {
            $this->_links = $links;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        public function getLinks()
        {
            return (array)$this->_links;
        }

        // ######################################

        /**
         * @return bool|PaypalSaleLinksVo
         */
        public function getPaypalSaleLinksVo()
        {
            $links = $this->getLinks();

            if ($links)
            {
                return (new PaypalSaleLinksVo())->setData($links);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param mixed $parentPaymentId
         *
         * @return PaypalSaleVo
         */
        public function setParentPaymentId($parentPaymentId)
        {
            $this->_parentPaymentId = $parentPaymentId;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getParentPaymentId()
        {
            return (string)$this->_parentPaymentId;
        }

        // ######################################

        /**
         * @param mixed $state
         *
         * @return PaypalSaleVo
         */
        public function setState($state)
        {
            $this->_state = $state;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getState()
        {
            return (string)$this->_state;
        }

        // ######################################

        /**
         * @param mixed $updateTime
         *
         * @return PaypalSaleVo
         */
        public function setUpdateTime($updateTime)
        {
            $this->_updateTime = $updateTime;

            return $this;
        }

        // ######################################

        /**
         * @return string
         */
        public function getUpdateTime()
        {
            return (string)$this->_updateTime;
        }
    }