<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsAllCountries extends AbstractSkrillPaymentMethods
    {
        /**
         * @return $this
         */
        public function useCardAllCardTypes()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_ALL_CARD_TYPES);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardVisa()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_VISA);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardMasterCard()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_MASTERCARD);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardVisaElectron()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_VISA_ELECTRON);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardAmericanExpress()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_AMERICAN_EXPRESS);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardDiners()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_DINERS);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardJCB()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_JCB);

            return $this;
        }
    }
