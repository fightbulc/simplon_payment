<?php

  namespace Simplon\Payment\Providers\PayPal;

  class PayPalProcess extends PayPalBase
  {
    /** @var \Simplon\Payment\Providers\PayPal\Vo\DetailsResponseVo */
    protected $_detailsResponseVo;

    /** @var \Simplon\Payment\Providers\PayPal\Vo\PaymentResponseVo */
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
     * @return Vo\DetailsResponseVo
     */
    public function getDetailsResponseVo()
    {
      return $this->_detailsResponseVo;
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
     * @return Vo\PaymentResponseVo
     */
    public function getPaymentResponseVo()
    {
      return $this->_paymentResponseVo;
    }

    // ##########################################

    /**
     * @return Vo\DetailsResponseVo
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

      return $this->_requestCheckoutDetails($postData);
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

      /** @var $detailsResponseVo \Simplon\Payment\Providers\PayPal\Vo\DetailsResponseVo */
      $detailsResponseVo = \Simplon\Payment\Providers\PayPal\Vo\DetailsResponseVo::init($response);

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
     * @return PayPalProcess
     */
    public function requestCheckoutPayment()
    {
      $detailsVo = $this->getDetailsResponseVo();

      // set post data
      $postData = array(
        'METHOD'        => 'DoExpressCheckoutPayment',
        'PAYMENTACTION' => 'Sale',
        'TOKEN'         => $this->getCheckoutToken(),
        'PAYERID'       => $detailsVo->getPayerId(),
        'AMT'           => $detailsVo->getOrderAmount(),
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

      /** @var $paymentResponseVo \Simplon\Payment\Providers\PayPal\Vo\PaymentResponseVo */
      $paymentResponseVo = \Simplon\Payment\Providers\PayPal\Vo\PaymentResponseVo::init($response);

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
