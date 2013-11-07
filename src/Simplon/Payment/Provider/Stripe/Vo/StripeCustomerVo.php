<?php

    namespace Simplon\Payment\Provider\Stripe\Vo;

    use Simplon\Helper\VoSetDataFactory;

    class StripeCustomerVo
    {
        protected $_id;
        protected $_object;
        protected $_created;
        protected $_liveMode;
        protected $_description;
        protected $_email;
        protected $_delinquent;
        protected $_metaData;
        protected $_subscription;
        protected $_discount;
        protected $_accountBalance;
        protected $_cards;
        protected $_defaultCard;

        /** @var  StripeCustomerCardsListVo */
        protected $_stripeCustomerCardsVo;

        // ######################################

        /**
         * @param array $data
         *
         * @return StripeCustomerVo
         */
        public function setData(array $data)
        {
            (new VoSetDataFactory())
                ->setRawData($data)
                ->setConditionByKey('object', function ($val) { $this->setObject($val); })
                ->setConditionByKey('created', function ($val) { $this->setCreated($val); })
                ->setConditionByKey('id', function ($val) { $this->setId($val); })
                ->setConditionByKey('livemode', function ($val) { $this->setLiveMode($val); })
                ->setConditionByKey('description', function ($val) { $this->setDescription($val); })
                ->setConditionByKey('email', function ($val) { $this->setEmail($val); })
                ->setConditionByKey('delinquent', function ($val) { $this->setDelinquent($val); })
                ->setConditionByKey('metadata', function ($val) { $this->setMetaData($val); })
                ->setConditionByKey('subscription', function ($val) { $this->setSubscription($val); })
                ->setConditionByKey('discount', function ($val) { $this->setDiscount($val); })
                ->setConditionByKey('account_balance', function ($val) { $this->setAccountBalance($val); })
                ->setConditionByKey('cards', function ($val) { $this->setCards($val); })
                ->setConditionByKey('default_card', function ($val) { $this->setDefaultCard($val); })
                ->run();

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        public function getData()
        {
            return [
                'object'          => $this->getObject(),
                'created'         => $this->getCreated(),
                'id'              => $this->getId(),
                'livemode'        => $this->getLiveMode(),
                'description'     => $this->getDescription(),
                'email'           => $this->getEmail(),
                'delinquent'      => $this->getDelinquent(),
                'metadata'        => $this->getMetaData(),
                'subscription'    => $this->getSubscription(),
                'discount'        => $this->getDiscount(),
                'account_balance' => $this->getAccountBalance(),
                'cards'           => $this->getCards(),
                'default_card'    => $this->getDefaultCard(),
            ];
        }

        // ######################################

        /**
         * @param mixed $accountBalance
         *
         * @return StripeCustomerVo
         */
        public function setAccountBalance($accountBalance)
        {
            $this->_accountBalance = $accountBalance;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getAccountBalance()
        {
            return $this->_accountBalance;
        }

        // ######################################

        /**
         * @param mixed $cards
         *
         * @return StripeCustomerVo
         */
        public function setCards($cards)
        {
            $this->_cards = $cards;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getCards()
        {
            return $this->_cards;
        }

        // ######################################

        /**
         * @return StripeCustomerCardsListVo
         */
        public function getStripeCustomerCardsVo()
        {
            if (!$this->_stripeCustomerCardsVo)
            {
                $this->_stripeCustomerCardsVo = (new StripeCustomerCardsListVo())->setData($this->getCards());
            }

            return $this->_stripeCustomerCardsVo;
        }

        // ######################################

        /**
         * @return StripeCardVo[]
         */
        public function getStripeCardVoMany()
        {
            return $this->getStripeCustomerCardsVo()
                ->getStripeCardVoMany();
        }

        // ######################################

        /**
         * @param mixed $created
         *
         * @return StripeCustomerVo
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
         * @param mixed $defaultCard
         *
         * @return StripeCustomerVo
         */
        public function setDefaultCard($defaultCard)
        {
            $this->_defaultCard = $defaultCard;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getDefaultCard()
        {
            return $this->_defaultCard;
        }

        // ######################################

        /**
         * @param mixed $delinquent
         *
         * @return StripeCustomerVo
         */
        public function setDelinquent($delinquent)
        {
            $this->_delinquent = $delinquent;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getDelinquent()
        {
            return $this->_delinquent;
        }

        // ######################################

        /**
         * @param mixed $description
         *
         * @return StripeCustomerVo
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
         * @param mixed $discount
         *
         * @return StripeCustomerVo
         */
        public function setDiscount($discount)
        {
            $this->_discount = $discount;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getDiscount()
        {
            return $this->_discount;
        }

        // ######################################

        /**
         * @param mixed $email
         *
         * @return StripeCustomerVo
         */
        public function setEmail($email)
        {
            $this->_email = $email;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->_email;
        }

        // ######################################

        /**
         * @param mixed $id
         *
         * @return StripeCustomerVo
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
         * @param mixed $liveMode
         *
         * @return StripeCustomerVo
         */
        public function setLiveMode($liveMode)
        {
            $this->_liveMode = $liveMode;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getLiveMode()
        {
            return $this->_liveMode;
        }

        // ######################################

        /**
         * @param mixed $metaData
         *
         * @return StripeCustomerVo
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
         * @return StripeCustomerVo
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
         * @param mixed $subscription
         *
         * @return StripeCustomerVo
         */
        public function setSubscription($subscription)
        {
            $this->_subscription = $subscription;

            return $this;
        }

        // ######################################

        /**
         * @return mixed
         */
        public function getSubscription()
        {
            return $this->_subscription;
        }
    }