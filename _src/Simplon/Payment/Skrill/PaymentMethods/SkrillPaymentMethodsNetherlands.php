<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsNetherlands extends SkrillPaymentMethodsAllCountries
    {
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
        public function useBankIdeal()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_IDEAL);

            return $this;
        }
    }
