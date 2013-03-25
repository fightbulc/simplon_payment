<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsDenmark extends SkrillPaymentMethodsAllCountries
    {
        /**
         * @return $this
         */
        public function useCardDankort()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_DANKORT);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankOnlineBankTransfer()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_ONLINE_BANK_TRANSFER);

            return $this;
        }
    }
