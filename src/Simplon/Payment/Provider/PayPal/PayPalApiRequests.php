<?php

    namespace Simplon\Payment\Provider\Paypal;

    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;

    class PaypalApiRequests
    {
        protected static $_clientId;
        protected static $_secret;
        protected static $_sandbox = FALSE;
        protected static $_accessToken;

        // ######################################

        /**
         * @param $apiKey
         */
        public static function setClientId($apiKey)
        {
            self::$_clientId = $apiKey;
        }

        // ######################################

        /**
         * @return string
         */
        protected static function _getClientId()
        {
            return (string)self::$_clientId;
        }

        // ######################################

        /**
         * @param $secret
         */
        public static function setSecret($secret)
        {
            self::$_secret = $secret;
        }

        // ######################################

        /**
         * @return string
         */
        protected static function _getSecret()
        {
            return (string)self::$_secret;
        }

        // ######################################

        /**
         * @param $sandbox
         */
        public static function setSandbox($sandbox)
        {
            self::$_sandbox = $sandbox;
        }

        // ######################################

        /**
         * @return bool
         */
        protected static function _isSandbox()
        {
            return self::$_sandbox;
        }

        // ######################################

        /**
         * @param $pathMethod
         * @param array $pathParams
         *
         * @return mixed
         */
        protected static function _parsePathPlaceholders($pathMethod, array $pathParams)
        {
            foreach ($pathParams as $k => $v)
            {
                $pathMethod = str_replace('{{' . $k . '}}', $v, $pathMethod);
            }

            return $pathMethod;
        }

        // ######################################

        /**
         * @return string
         */
        protected static function _getUrlApiRoot()
        {
            if (self::_isSandbox() === TRUE)
            {
                return PaypalApiConstants::URL_API_ROOT_SANDBOX;
            }

            return PaypalApiConstants::URL_API_ROOT_LIVE;
        }

        // ######################################

        /**
         * @return string
         * @throws \Simplon\Payment\PaymentException
         */
        protected static function _getAccessToken()
        {
            if (!self::$_accessToken)
            {
                $header = [
                    'Accept: application/json',
                    'Accept-Language: en_US'
                ];

                $response = \CURL::init(self::_getUrlApiRoot() . PaypalApiConstants::PATH_OAUTH_TOKEN)
                    ->setHttpHeader($header)
                    ->setHttpAuth(CURLAUTH_BASIC)
                    ->setUserPwd(self::_getClientId() . ":" . self::_getSecret())
                    ->setPostFields('grant_type=client_credentials')
                    ->setReturnTransfer(TRUE)
                    ->execute();

                $response = json_decode($response, TRUE);

                if ($response === NULL || !isset($response['access_token']))
                {
                    throw new PaymentException(
                        PaymentExceptionConstants::ERR_API_CODE,
                        PaymentExceptionConstants::ERR_API_MESSAGE,
                        $response
                    );
                }

                self::$_accessToken = (string)$response['access_token'];
            }

            return self::$_accessToken;
        }

        // ######################################

        /**
         * @param string $requestType
         * @param $pathMethod
         * @param array $postData
         *
         * @return bool|mixed
         * @throws \Simplon\Payment\PaymentException
         */
        protected static function _callApi($requestType = 'GET', $pathMethod, array $postData = [])
        {
            $header = [
                'Content-Type: application/json',
                'Authorization:Bearer ' . self::_getAccessToken(),
            ];

            $curl = \CURL::init(self::_getUrlApiRoot() . $pathMethod)
                ->setHttpHeader($header)
                ->setReturnTransfer(TRUE);

            // ----------------------------------
            // add post data

            if ($requestType === 'POST')
            {
                $curl
                    ->setCustomRequest('POST')
                    ->setPostFields(json_encode($postData));
            }

            // ----------------------------------
            // handle delete

            if ($requestType === 'DELETE')
            {
                $curl->setCustomRequest('DELETE');
            }

            // ----------------------------------
            // send request

            return self::_processResponse($curl->execute());
        }

        // ######################################

        /**
         * @param $response
         *
         * @return bool|mixed
         * @throws \Simplon\Payment\PaymentException
         */
        protected static function _processResponse($response)
        {
            if ($response)
            {
                $response = json_decode($response, TRUE);

                if (isset($response['debug_id']))
                {
                    $error = $response;

                    if ((string)$error['name'] === 'MALFORMED_REQUEST')
                    {
                        $code = PaymentExceptionConstants::ERR_API_CODE;
                        $message = PaymentExceptionConstants::ERR_API_MESSAGE;
                        unset($error['name']);
                    }

                    elseif ((string)$error['name'] === 'VALIDATION_ERROR')
                    {
                        $code = PaymentExceptionConstants::ERR_REQUEST_CODE;
                        $message = PaymentExceptionConstants::ERR_REQUEST_MESSAGE;
                        unset($error['name']);
                    }

                    elseif ((string)$error['name'] === 'card_error')
                    {
                        $code = PaymentExceptionConstants::ERR_PAYMENT_DATA_CODE;
                        $message = PaymentExceptionConstants::ERR_PAYMENT_DATA_MESSAGE;
                        unset($error['name']);
                    }

                    else
                    {
                        $code = PaymentExceptionConstants::ERR_UNKNOWN_CODE;
                        $message = PaymentExceptionConstants::ERR_UNKNOWN_MESSAGE;
                    }

                    throw new PaymentException($code, $message, $error);
                }

                return $response;
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param $pathMethod
         * @param array $placeholder
         *
         * @return bool|mixed
         */
        public static function retrieve($pathMethod, array $placeholder = [])
        {
            if (!empty($placeholder))
            {
                $pathMethod = self::_parsePathPlaceholders($pathMethod, $placeholder);
            }

            return self::_callApi('GET', $pathMethod);
        }

        // ######################################

        /**
         * @param $pathMethod
         * @param array $postData
         *
         * @return bool|mixed
         */
        public static function create($pathMethod, array $postData)
        {
            return self::_callApi('POST', $pathMethod, $postData);
        }

        // ######################################

        /**
         * @param $pathMethod
         * @param array $placeholder
         * @param array $postData
         *
         * @return bool|mixed
         */
        public static function update($pathMethod, array $placeholder, array $postData)
        {
            $pathMethod = self::_parsePathPlaceholders($pathMethod, $placeholder);

            return self::_callApi('POST', $pathMethod, $postData);
        }

        // ######################################

        /**
         * @param $pathMethod
         * @param array $placeholder
         *
         * @return bool|mixed
         */
        public static function delete($pathMethod, array $placeholder)
        {
            $pathMethod = self::_parsePathPlaceholders($pathMethod, $placeholder);

            return self::_callApi('DELETE', $pathMethod);
        }
    }