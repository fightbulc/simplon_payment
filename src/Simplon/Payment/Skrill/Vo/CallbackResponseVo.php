<?php

  namespace Simplon\Payment\Skrill\Vo;

  class CallbackResponseVo
  {
    protected $_postData = [];
    protected $_customCallbackData = [];

    // ##########################################

    /**
     * @return mixed
     */
    protected function _getPostData()
    {
      return $this->_postData;
    }

    // ##########################################

    /**
     * @param $key
     * @return string|bool
     */
    protected function _getPostDataByKey($key)
    {
      if(isset($this->_postData[$key]))
      {
        return $this->_postData[$key];
      }

      return FALSE;
    }

    // ##########################################

    /**
     * @param array $postData
     * @return $this
     */
    public function setData(array $postData)
    {
      // set post data
      $this->_postData = $postData;

      // identify custom callback fields
      $this->_filterCustomCallbackFields();

      return $this;
    }

    // ##########################################

    /**
     * @return $this
     */
    protected function _filterCustomCallbackFields()
    {
      $postData = $this->_getPostData();

      foreach($postData as $k => $v)
      {
        if(strpos($k, 'custom_') !== FALSE)
        {
          $this->_addCustomCallbackField(substr($k, 7), $v);
        }
      }

      return $this;
    }

    // ##########################################

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    protected function _addCustomCallbackField($key, $value)
    {
      $this->_customCallbackData[$key] = $value;

      return $this;
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillSha2Signature()
    {
      return $this->_getPostDataByKey('sha2sig');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillMd5Signature()
    {
      return $this->_getPostDataByKey('md5sig');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillStatus()
    {
      return $this->_getPostDataByKey('status');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillTransactionId()
    {
      return $this->_getPostDataByKey('mb_transaction_id');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillAmount()
    {
      return $this->_getPostDataByKey('mb_amount');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillCurrency()
    {
      return $this->_getPostDataByKey('mb_currency');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillMerchantId()
    {
      return $this->_getPostDataByKey('merchant_id');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getPostedTransactionId()
    {
      return $this->_getPostDataByKey('transaction_id');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillCustomerId()
    {
      return $this->_getPostDataByKey('customer_id');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getPostedAmount()
    {
      return $this->_getPostDataByKey('amount');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getPostedCurrency()
    {
      return $this->_getPostDataByKey('currency');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillPaymentType()
    {
      return $this->_getPostDataByKey('payment_type');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getPostedMerchantAccountEmail()
    {
      return $this->_getPostDataByKey('pay_to_email');
    }

    // ##########################################

    /**
     * @return bool|string
     */
    public function getSkrillPayFromEmail()
    {
      return $this->_getPostDataByKey('pay_from_email');
    }

    // ##########################################

    /**
     * @return array
     */
    public function getPostedCustomCallbackData()
    {
      return $this->_customCallbackData;
    }
  }
