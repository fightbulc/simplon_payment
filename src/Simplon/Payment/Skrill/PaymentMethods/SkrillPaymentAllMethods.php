<?php
    namespace Simplon\Payment\Skrill\PaymentMethods;

    class SkrillPaymentAllMethods extends AbstractSkrillPaymentMethods
    {
        /**
         * @return $this
         */
        public function useCardAllCardTypes()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_ALL_CARD_TYPES);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardVisa()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_VISA);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardMasterCard()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_MASTERCARD);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardVisaElectron()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_VISA_ELECTRON);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardAmericanExpress()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_AMERICAN_EXPRESS);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardDiners()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_DINERS);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardJCB()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_JCB);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardLaser()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_LASER);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useCardVisaDeltaDebit()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_VISA_DELTA_DEBIT);

            return $this;
        }

        // ##########################################

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
        public function useCardCarteBleue()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_CARTE_BLEUE);

            return $this;
        }

        // ##########################################

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

        // ##########################################

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
        public function useBankNordeaPoland()
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

        // ##########################################

        /**
         * @return $this
         */
        public function useBankEpayBG()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_EPAY_BG);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankNordeaSoloSweden()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_NORDEA_SOLO_SWEDEN);

            return $this;
        }

        // ##########################################

        /**
         * @return $this
         */
        public function useBankNordeaSoloFinland()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_NORDEA_SOLO_FINLAND);

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

        // ##########################################

        /**
         * @return $this
         */
        public function useBankPOLi()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_POLI);

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

        // ##########################################

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
        public function useBankEnets()
        {
            $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_ENETS);

            return $this;
        }
    }
