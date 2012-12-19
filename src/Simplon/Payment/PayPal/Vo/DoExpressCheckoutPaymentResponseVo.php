<?php

  namespace Simplon\Payment\PayPal\Vo;

  class DoExpressCheckoutPaymentResponseVo extends AbstractVo
  {
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
    public function getTransactionType()
    {
      return $this->_getByKey('transactiontype');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getPaymentType()
    {
      return $this->_getByKey('paymenttype');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderTime()
    {
      return $this->_getByKey('ordertime');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderAmount()
    {
      return $this->_getByKey('amt');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderCurrencyCode()
    {
      return $this->_getByKey('currencycode');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getOrderTaxAmount()
    {
      return $this->_getByKey('taxamt');
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
