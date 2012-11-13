<?php

  namespace Simplon\Payment\Providers\PayPal\Vo;

  class PaymentResponseVo extends AbstractVo
  {
    /**
     * @return bool|mixed
     */
    public function getTransactionId()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_TRANSACTIONID');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getTransactionType()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_TRANSACTIONTYPE');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPaymentType()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_PAYMENTTYPE');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderTime()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_ORDERTIME');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderAmount()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_AMT');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderCurrencyCode()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_CURRENCYCODE');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderTaxAmount()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_TAXAMT');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPaymentStatus()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_PAYMENTSTATUS');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPendingReason()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_PENDINGREASON');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPendingReasonCode()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_REASONCODE');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getShipToState()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOSTATE');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getShipToCountryCode()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getShipToCountryName()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getShipToZip()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_SHIPTOZIP');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getAddressId()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_ADDRESSID');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getAddressStatus()
    {
      return $this->_getByKey('PAYMENTREQUEST_0_ADDRESSSTATUS');
    }
  }
