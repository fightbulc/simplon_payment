<?php

  namespace Simplon\Payment\PayPal\Vo;

  class DoExpressCheckoutPaymentResponseVo extends AbstractVo
  {
    /**
     * @return bool|mixed
     */
    public function getToken()
    {
      return $this->_getByKey('token');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getCorrelationId()
    {
      return $this->_getByKey('correlationid');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getTransactionId()
    {
      return $this->_getByKey('paymentinfo_0_transactionid');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getTransactionType()
    {
      return $this->_getByKey('paymentinfo_0_transactiontype');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPaymentType()
    {
      return $this->_getByKey('paymentinfo_0_paymenttype');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderTime()
    {
      return $this->_getByKey('paymentinfo_0_ordertime');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderAmount()
    {
      return $this->_getByKey('paymentinfo_0_amt');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderTaxAmount()
    {
      return $this->_getByKey('paymentinfo_0_taxamt');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderCurrencyCode()
    {
      return $this->_getByKey('paymentinfo_0_currencycode');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPaymentStatus()
    {
      return $this->_getByKey('paymentstatus');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPendingReason()
    {
      return $this->_getByKey('pendingreason');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPendingReasonCode()
    {
      return $this->_getByKey('reasoncode');
    }
  }
