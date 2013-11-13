<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive;

    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;

    class PaypalApiRequests
    {
        protected static $_username;
        protected static $_password;
        protected static $_signature;
        protected static $_appId;
        protected static $_sandbox = FALSE;

        // ######################################

        /**
         * @param $username
         */
        public static function setUsername($username)
        {
            self::$_username = $username;
        }

        // ######################################

        /**
         * @return string
         */
        protected static function _getUsername()
        {
            return (string)self::$_username;
        }

        // ######################################

        /**
         * @param $password
         */
        public static function setPassword($password)
        {
            self::$_password = $password;
        }

        // ######################################

        /**
         * @return string
         */
        protected static function _getPassword()
        {
            return (string)self::$_password;
        }

        // ######################################

        /**
         * @param $signature
         */
        public static function setSignature($signature)
        {
            self::$_signature = $signature;
        }

        // ######################################

        /**
         * @return string
         */
        protected static function _getSignature()
        {
            return (string)self::$_signature;
        }

        // ######################################

        /**
         * @param $appId
         */
        public static function setAppId($appId)
        {
            self::$_appId = $appId;
        }

        // ######################################

        /**
         * @return string
         */
        protected static function _getAppId()
        {
            return (string)self::$_appId;
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
                'X-PAYPAL-SECURITY-USERID: ' . self::_getUsername(),
                'X-PAYPAL-SECURITY-PASSWORD: ' . self::_getPassword(),
                'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
                'X-PAYPAL-RESPONSE-DATA-FORMAT: JSON',
                'X-PAYPAL-APPLICATION-ID: ' . self::_getAppId(),
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
                    ->setPostFields(http_build_query($postData));
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

                    if ((string)$error['name'] === 'INTERNAL_SERVICE_ERROR')
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
         * @param array $postData
         *
         * @return bool|mixed
         */
        public static function request($pathMethod, array $postData)
        {
            return self::_callApi('POST', $pathMethod, $postData);
        }
    }