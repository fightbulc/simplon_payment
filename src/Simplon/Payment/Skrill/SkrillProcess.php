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

      // parse response && throw Exception if failed
      $data = $this->_parseResponse($response);

      /** @var $checkoutResponseVo CheckoutQueryResponseVo */
      $checkoutResponseVo = (new CheckoutQueryResponseVo())->setData($data);

      return $checkoutResponseVo;
    }

    // ##########################################

    /**
     * @param $response
     * @return mixed
     * @throws \Exception
     */
    protected function _parseResponse($response)
    {
      // remove trailing NEW_LINE
      $response = chop($response);

      /**
       * We need to filter out any failings. For instance:
       * 401   Cannot login: remote ip (1.2.3.4) is not in list of allowed ips
       */

      // check if we got valid response
      if(! preg_match('/200\s*ok.*?/', $response))
      {
        throw new \Exception(__CLASS__ . ': failed response: <' . $response . '>');
      }

      // remove response code
      $response = preg_replace('/200\s*ok.*?\n/i', '', chop($response));

      // parse response
      parse_str($response, $data);

      return $data;
    }
  }
