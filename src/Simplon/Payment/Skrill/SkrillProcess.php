<?php

  namespace Simplon\Payment\Skrill;

  use Simplon\Payment\Skrill\Vo\CheckoutQueryResponseVo;

  class SkrillProcess extends SkrillBase
  {
    /**
     * @param $merchantEmailAccount
     * @param $gatewayPassword
     * @param $transactionId
     * @return Vo\CheckoutQueryResponseVo
     */
    public function getCheckoutDetailsByMerchantTransactionId($merchantEmailAccount, $gatewayPassword, $transactionId)
    {
      // build query string
      // $postDataQuery = http_build_query($postData);
      $parameter = 'action=status_trn&email=' . $merchantEmailAccount . '&password=' . md5($gatewayPassword) . '&trn_id=' . $transactionId;

      // call paypal
      $response = $this
        ->_getCurlClass()
        ->init($this->_getUrlQueryGateway() . '?' . $parameter)
        ->setReturnTransfer(TRUE)
        ->execute();

      // remove first line
      $response = preg_replace('/200\s*ok.*?\n/i', '', chop($response));

      // parse response
      parse_str($response, $data);

      /** @var $checkoutResponseVo CheckoutQueryResponseVo */
      $checkoutResponseVo = (new CheckoutQueryResponseVo())->setData($data);

      return $checkoutResponseVo;
    }
  }
