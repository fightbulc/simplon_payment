<?php
  namespace Simplon\Payment\Skrill\PaymentMethods;

  class SkrillPaymentMethodsSingapore extends SkrillPaymentMethodsAllCountries
  {
    /**
     * @return $this
     */
    public function useBankPOLi()
    {
      $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::BANK_POLI);

      return $this;
    }
  }
