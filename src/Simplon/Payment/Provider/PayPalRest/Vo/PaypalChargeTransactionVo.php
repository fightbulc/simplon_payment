<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class PaypalChargeTransactionVo
    {
        protected $_amount;
        protected $_relatedResources;

        /** @var  PaypalSaleVo */
        protected $_paypalSaleVo;

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
                ->setConditionByKey('amount', function ($val) { $this->setAmount($val); })
                ->setConditionByKey('related_resources', function ($val) { $this->setRelatedResources($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param array $amount
         *
         * @return PaypalChargeTransactionVo
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
        public function getAmount()
        {
            return (array)$this->_amount;
        }

        // ######################################

        /**
         * @param mixed $relatedResources
         *
         * @return PaypalChargeTransactionVo
         */
        public function setRelatedResources($relatedResources)
        {
            $this->_relatedResources = $relatedResources;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        protected function _getRelatedResources()
        {
            return (array)$this->_relatedResources;
        }

        // ######################################

        /**
         * @return bool|PaypalSaleVo
         */
        public function getPaypalSaleVo()
        {
            $relatedResources = $this->_getRelatedResources();

            if ($relatedResources && isset($relatedResources[0]) && isset($relatedResources[0]['sale']))
            {
                return (new PaypalSaleVo())->setData($relatedResources[0]['sale']);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getCurrency()
        {
            $amount = $this->getAmount();

            if ($amount['currency'])
            {
                return (string)$amount['currency'];
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getDescription()
        {
            $amount = $this->getAmount();

            if ($amount['description'])
            {
                return (string)$amount['description'];
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return array|bool
         */
        public function getAmountDetails()
        {
            $amount = $this->getAmount();

            if ($amount['details'])
            {
                return (array)$amount['details'];
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|int
         */
        public function getDetailsSubtotalCents()
        {
            $amountDetails = $this->getAmountDetails();

            if ($amountDetails['subtotal'])
            {
                return (int)((float)$amountDetails['subtotal'] * 100);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|int
         */
        public function getDetailsTaxCents()
        {
            $amountDetails = $this->getAmountDetails();

            if ($amountDetails['tax'])
            {
                return (int)((float)$amountDetails['tax'] * 100);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|int
         */
        public function getDetailsFeeCents()
        {
            $amountDetails = $this->getAmountDetails();

            if ($amountDetails['fee'])
            {
                return (int)((float)$amountDetails['fee'] * 100);
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|int
         */
        public function getTotalCents()
        {
            $amount = $this->getAmount();

            if ($amount['total'])
            {
                return (int)((float)$amount['total'] * 100);
            }

            return FALSE;
        }
    }