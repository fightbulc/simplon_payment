<?php

  namespace Simplon\Payment\Skrill\PaymentMethods;

  interface InterfaceSkrillPaymentMethods
  {

    public function getEnabledMethodCodes();

    public function getEnabledMethodCodesAsString();
  }
