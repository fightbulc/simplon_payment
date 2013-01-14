<?php
  namespace Simplon\Payment\Skrill\PaymentMethods;

  class SkrillPaymentMethodsIreland extends SkrillPaymentMethodsAllCountries
  {
    /**
     * @return $this
     */
    public function useCardLaser()
    {
      $this->_addEnabledMethodCode(AbstractSkrillPaymentMethods::CARD_LASER);

      return $this;
    }
  }
