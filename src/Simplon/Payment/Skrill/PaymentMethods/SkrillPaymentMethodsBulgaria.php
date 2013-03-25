<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsBulgaria extends SkrillPaymentMethodsAllCountries
    {
        /**
         * @return $this
         */
        public function useBankEpayBG()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_EPAY_BG);

            return $this;
        }
    }
