<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsSingapore extends SkrillPaymentMethodsAllCountries
    {
        /**
         * @return $this
         */
        public function useBankEnets()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_ENETS);

            return $this;
        }
    }
