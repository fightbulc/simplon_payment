<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsGermany extends SkrillPaymentMethodsAllCountries
    {
        /**
         * @return $this
         */
        public function useBankOnlineBankTransfer()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_ONLINE_BANK_TRANSFER);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankGiropay()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_GIROPAY);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankDirectDebitElv()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_DIRECT_DEBIT_ELV);

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
    }
