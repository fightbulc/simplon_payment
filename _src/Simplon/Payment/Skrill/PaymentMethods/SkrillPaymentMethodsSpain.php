<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsSpain extends SkrillPaymentMethodsAllCountries
    {
        /**
         * @return $this
         */
        public function useCardMaestro()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_MAESTRO);

            return $this;
        }
    }
