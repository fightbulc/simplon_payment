<?php
  namespace Simplon\Payment\Skrill\PaymentMethods;

  class SkrillPaymentMethodsUnitedKingdom extends SkrillPaymentMethodsAllCountries
  {
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
    public function useBankOnlineBankTransfer()
    {
      $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_ONLINE_BANK_TRANSFER);

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
