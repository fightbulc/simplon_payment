<?php

    namespace Simplon\Payment\Skrill;

    use Simplon\Payment\Skrill\Vo\CheckoutQueryResponseVo;

    class SkrillProcess extends SkrillBase
    {
        /** @var array */
        protected $_acceptableErrorCodes = [401, 402, 403, 404, 405];

        // ######################################

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

            // if NOT code 200 --> filter error message
            if(! preg_match('/200\s*ok.*?/', $response))
            {
                // clear response format
                $response = preg_replace('/\s+/u', ' ', $response);

                // get error code from response
                preg_match('/^(\d{3})/', $response, $regexp);
                $errorCode = $regexp[1];

                // if unknown error code set to 500
                if(! in_array($errorCode, $this->_acceptableErrorCodes))
                {
                    $errorCode = 500;
                }

                // throw exception with response and error code
                throw new \Exception(__CLASS__ . ': failed response code: <' . $response . '>', $errorCode);
            }

            // remove response code
            $response = preg_replace('/200\s*ok.*?\n/i', '', $response);

            // parse response
            parse_str($response, $data);

            return $data;
        }
    }
