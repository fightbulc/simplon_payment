<?php

  namespace Simplon\Payment\PayPal;

  use Simplon\Payment\PayPal\Vo\GetExpressCheckoutDetailsResponseVo;
  use Simplon\Payment\PayPal\Vo\DoExpressCheckoutPaymentResponseVo;

  class PayPalProcess extends PayPalBase
  {
    /** @var GetExpressCheckoutDetailsResponseVo */
    protected $_getExpressCheckoutDetailsResponseVo;

    /** @var DoExpressCheckoutPaymentResponseVo */
    protected $_paymentResponseVo;

    // ##########################################

    /**
     * @return PayPalProcess
     */
    public function requestGetExpressCheckoutDetails()
    {
      // set post data
      $postData = array(
        'METHOD' => 'GetExpressCheckoutDetails',
        'TOKEN'  => $this->getCheckoutToken(),
      );

      // add auth credentials
      $authCredentials = $this->_getAuthCredentials();
      $postData = array_merge($postData, $authCredentials);

      // request details
      $this->_requestCheckoutDetails($postData);

      return $this;
    }

    // ##########################################

    /**
     * @param $postData
     * @return PayPalProcess
     */
    protected function _requestCheckoutDetails($postData)
    {
      // build query string
      $postDataQuery = http_build_query($postData);

      // call paypal
      $response = $this
        ->_getCurlClass()
        ->init($this->_getUrlApi())
        ->setPost(TRUE)
        ->setPostFields($postDataQuery)
        ->setReturnTransfer(TRUE)
        ->execute();

      /** @var $getExpressCheckoutDetailsResponseVo GetExpressCheckoutDetailsResponseVo */
      $getExpressCheckoutDetailsResponseVo = GetExpressCheckoutDetailsResponseVo::init($response);

      // throw exception on fail
      if($getExpressCheckoutDetailsResponseVo->isSuccess() === FALSE)
      {
        $this->_throwException('requestGetExpressCheckoutDetails failed with errors: ' . $getExpressCheckoutDetailsResponseVo->getErrors());
      }

      // all cool; set vo
      $this->_setGetExpressCheckoutDetailsResponseVo($getExpressCheckoutDetailsResponseVo);

      return $this;
    }

    // ##########################################

    /**
     * @param Vo\GetExpressCheckoutDetailsResponseVo $vo
     * @return PayPalProcess
     */
    protected function _setGetExpressCheckoutDetailsResponseVo(GetExpressCheckoutDetailsResponseVo $vo)
    {
      $this->_getExpressCheckoutDetailsResponseVo = $vo;

      return $this;
    }

    // ##########################################

    /**
     * @return bool|Vo\GetExpressCheckoutDetailsResponseVo
     */
    public function getGetExpressCheckoutDetailsResponseVo()
    {
      if(isset($this->_getExpressCheckoutDetailsResponseVo))
      {
        return $this->_getExpressCheckoutDetailsResponseVo;
      }

      return FALSE;
    }

    // ##########################################

    /**
     * @param $payerId
     * @param $orderAmount
     * @param $currencyCode
     * @return PayPalProcess
     */
    public function requestDoExpressCheckoutPayment($payerId, $orderAmount, $currencyCode)
    {
      // set post data
      $postData = array(
        'METHOD'                         => 'DoExpressCheckoutPayment',
        'TOKEN'                          => $this->getCheckoutToken(),
        'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
        'PAYERID'                        => $payerId,
        'PAYMENTREQUEST_0_AMT'           => $orderAmount,
        'PAYMENTREQUEST_0_CURRENCYCODE'  => $currencyCode,
      );

      // add auth credentials
      $authCredentials = $this->_getAuthCredentials();
      $postData = array_merge($postData, $authCredentials);

      return $this->_requestCheckoutPayment($postData);
    }

    // ##########################################

    /**
     * @param $postData
     * @return PayPalProcess
     */
    protected function _requestCheckoutPayment($postData)
    {
      // build query string
      $postDataQuery = http_build_query($postData);

      // call paypal
      $response = $this
        ->_getCurlClass()
        ->init($this->_getUrlApi())
        ->setPost(TRUE)
        ->setPostFields($postDataQuery)
        ->setReturnTransfer(TRUE)
        ->execute();

      /** @var $doExpressCheckoutPaymentResponseVo DoExpressCheckoutPaymentResponseVo */
      $doExpressCheckoutPaymentResponseVo = DoExpressCheckoutPaymentResponseVo::init($response);

      // throw exception on fail
      if($doExpressCheckoutPaymentResponseVo->isSuccess() === FALSE)
      {
        $this->_throwException('requestDoExpressCheckoutPayment failed with errors: ' . $doExpressCheckoutPaymentResponseVo->getErrors());
      }

      // all cool; set vo
      $this->_setDoExpressCheckoutPaymentResponseVo($doExpressCheckoutPaymentResponseVo);

      return $this;
    }

    // ##########################################

    /**
     * @param Vo\DoExpressCheckoutPaymentResponseVo $vo
     * @return PayPalProcess
     */
    protected function _setDoExpressCheckoutPaymentResponseVo(DoExpressCheckoutPaymentResponseVo $vo)
    {
      $this->_paymentResponseVo = $vo;

      return $this;
    }

    // ##########################################

    /**
     * @return bool|Vo\DoExpressCheckoutPaymentResponseVo
     */
    public function getPaymentResponseVo()
    {
      if(isset($this->_paymentResponseVo))
      {
        return $this->_paymentResponseVo;
      }

      return FALSE;
    }
  }
