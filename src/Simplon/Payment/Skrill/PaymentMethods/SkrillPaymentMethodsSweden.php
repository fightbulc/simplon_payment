<?php
  namespace Simplon\Payment\Skrill\PaymentMethods;

  class SkrillPaymentMethodsSweden extends SkrillPaymentMethodsAllCountries
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
    public function useBankNordeaSolo()
    {
      $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_NORDEA_SOLO_SWEDEN);

      return $this;
    }
  }
