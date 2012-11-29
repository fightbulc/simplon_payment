<?php

  namespace Simplon\Payment\PayPal;

  use Simplon\Payment\PayPal\Vo\PaymentResponseVo;
  use Simplon\Payment\PayPal\Vo\DetailsResponseVo;

  class PayPalProcess extends PayPalBase
  {
    /** @var \Simplon\Payment\PayPal\Vo\DetailsResponseVo */
    protected $_detailsResponseVo;

    /** @var \Simplon\Payment\PayPal\Vo\PaymentResponseVo */
    protected $_paymentResponseVo;

    // ##########################################

    /**
     * @param $vo
     * @return PayPalProcess
     */
    protected function _setDetailsResponseVo($vo)
    {
      $this->_detailsResponseVo = $vo;

      return $this;
    }

    // ##########################################

    /**
     * @return bool|Vo\DetailsResponseVo
     */
    public function getDetailsResponseVo()
    {
      if(isset($this->_detailsResponseVo))
      {
        return $this->_detailsResponseVo;
      }

      return FALSE;
    }

    // ##########################################

    /**
     * @param $vo
     * @return PayPalProcess
     */
    protected function _setPaymentResponseVo($vo)
    {
      $this->_paymentResponseVo = $vo;

      return $this;
    }

    // ##########################################

    /**
     * @return bool|Vo\PaymentResponseVo
     */
    public function getPaymentResponseVo()
    {
      if(isset($this->_paymentResponseVo))
      {
        return $this->_paymentResponseVo;
      }

      return FALSE;
    }

    // ##########################################

    /**
     * @return PayPalProcess
     */
    public function requestCheckoutDetails()
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

      /** @var $detailsResponseVo DetailsResponseVo */
      $detailsResponseVo = DetailsResponseVo::init($response);

      // throw exception on fail
      if($detailsResponseVo->isSuccess() === FALSE)
      {
        $this->_throwException('requestCheckoutDetails failed with errors: ' . $detailsResponseVo->getErrors());
      }

      // all cool; set vo
      $this->_setDetailsResponseVo($detailsResponseVo);

      return $this;
    }

    // ##########################################

    /**
     * @param $payerId
     * @param $orderAmount
     * @return PayPalProcess
     */
    public function requestCheckoutPayment($payerId, $orderAmount)
    {
      // set post data
      $postData = array(
        'METHOD'        => 'DoExpressCheckoutPayment',
        'PAYMENTACTION' => 'Sale',
        'TOKEN'         => $this->getCheckoutToken(),
        'PAYERID'       => $payerId,
        'AMT'           => $orderAmount,
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

      /** @var $paymentResponseVo PaymentResponseVo */
      $paymentResponseVo = PaymentResponseVo::init($response);

      // throw exception on fail
      if($paymentResponseVo->isSuccess() === FALSE)
      {
        $this->_throwException('requestCheckoutPayment failed with errors: ' . $paymentResponseVo->getErrors());
      }

      // all cool; set vo
      $this->_setPaymentResponseVo($paymentResponseVo);

      return $this;
    }
  }
