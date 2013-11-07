<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsFrance extends SkrillPaymentMethodsAllCountries
    {
        /**
         * @return $this
         */
        public function useCardCarteBleue()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_CARTE_BLEUE);

            return $this;
        }
    }
