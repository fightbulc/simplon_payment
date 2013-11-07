<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Helper\VoManyFactory;
    use Simplon\Helper\VoSetDataFactory;

    class StripeCustomerCardsListVo
    {
        protected $_object;
        protected $_count;
        protected $_url;
        protected $_dataMany;

        /** @var  StripeCardVo[] */
        protected $_stripeCardVoMany;

        // ######################################

        /**
         * @param array $data
         *
         * @return StripeCustomerCardsListVo
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
         * @return StripeCustomerCardsListVo
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
         * @return StripeCardVo[]
         */
        public function getStripeCardVoMany()
        {
            if (!$this->_stripeCardVoMany)
            {
                $this->_stripeCardVoMany = VoManyFactory::factory($this->getDataMany(), function ($key, $val)
                {
                    return (new StripeCardVo())->setData($val);
                });
            }

            return $this->_stripeCardVoMany;
        }

        // ######################################

        /**
         * @param mixed $count
         *
         * @return StripeCustomerCardsListVo
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
         * @return StripeCustomerCardsListVo
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
         * @return StripeCustomerCardsListVo
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