<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsItaly extends SkrillPaymentMethodsAllCountries
    {
        /**
         * @return $this
         */
        public function useCardPostePay()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_POSTEPAY);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardCartaSi()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_CARTASI);

            return $this;
        }
    }
