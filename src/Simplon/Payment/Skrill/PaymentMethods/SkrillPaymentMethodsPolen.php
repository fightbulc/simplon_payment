<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentMethodsPolen extends SkrillPaymentMethodsAllCountries
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
        public function useBankAllBanks()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_ALL_POLISH_BANKS);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankIngBankSlaski()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_ING_BANK_SLASKI);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankPkoBp()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_PKO_BP);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankMultibank()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_MULTIBANK);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankLukasBank()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_LUKAS_BANK);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankBPH()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_BANK_BPH);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankInvestBank()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_INVESTBANK);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankPekaoSa()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_PEKAO_SA);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankCitibankHandlowy()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_CITIBANK_HANDLOWY);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankZachodniWBK()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_BANK_ZACHODNI_WBK);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankBGZ()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_BGZ);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankMillenium()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_MILLENIUM);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankMBank()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_MBANK);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankPlaceZInteligo()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_PLACE_Z_INTELIGO);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankOchronySrodowiska()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_BANK_OCHRONY_SRODOWISKA);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankNordea()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_NORDEA_POLAND);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankFortisBank()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_FORTIS_BANK);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankDeutscheBankPBC()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_DEUTSCHE_BANK_PBC);

            return $this;
        }
    }
