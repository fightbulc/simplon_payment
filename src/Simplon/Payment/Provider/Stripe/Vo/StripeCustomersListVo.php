<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Helper\VoManyFactory;
    use Simplon\Helper\VoSetDataFactory;

    class StripeCustomersListVo
    {
        protected $_object;
        protected $_count;
        protected $_url;
        protected $_dataMany;

        /** @var  StripeCustomerVo[] */
        protected $_stripeCustomerVoMany;

        // ######################################

        /**
         * @param array $data
         *
         * @return StripeCustomersListVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('object', function ($val) { $this->setObject($val); })
                ->setConditionByKey('count', function ($val) { $this->setCount($val); })
                ->setConditionByKey('url', function ($val) { $this->setUrl($val); })
                ->setConditionByKey('data', function ($val) { $this->setDataMany($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @param mixed $stripeCardDataMany
         *
         * @return StripeCustomersListVo
         */
        public function setDataMany(array $stripeCardDataMany)
        {
            $this->_dataMany = $stripeCardDataMany;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getDataMany()
        {
            return $this->_dataMany;
        }

        // ######################################

        /**
         * @return StripeCustomerVo[]
         */
        public function getStripeCustomerVoMany()
        {
            if (!$this->_stripeCustomerVoMany)
            {
                $this->_stripeCustomerVoMany = VoManyFactory::factory($this->getDataMany(), function ($key, $val)
                {
                    return (new StripeCustomerVo())->setData($val);
                });
            }

            return $this->_stripeCustomerVoMany;
        }

        // ######################################

        /**
         * @param mixed $count
         *
         * @return StripeCustomersListVo
         */
        public function setCount($count)
        {
            $this->_count = $count;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCount()
        {
            return $this->_count;
        }

        // ######################################

        /**
         * @param mixed $object
         *
         * @return StripeCustomersListVo
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
         * @param mixed $url
         *
         * @return StripeCustomersListVo
         */
        public function setUrl($url)
        {
            $this->_url = $url;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getUrl()
        {
            return $this->_url;
        }
    } 