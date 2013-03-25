<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsAustria extends SkrillPaymentMethodsAllCountries
    {
        /**
         * @return $this
         */
        public function useCardMaestro()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_MAESTRO);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankSofortueberweisung()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_SOFORTUEBERWEISUNG);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankEpsNetpay()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_EPS_NETPAY);

            return $this;
        }
    }
