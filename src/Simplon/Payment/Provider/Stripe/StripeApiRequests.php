<?php

    namespace Simplon\Payment\Provider\Stripe;

    use Simplon\Payment\PaymentException;
    use Simplon\Payment\PaymentExceptionConstants;

    class StripeApiRequests
    {
        protected static $_apiKey;

        // ######################################

        /**
         * @param $apiKey
         */
        public static function setApiKey($apiKey)
        {
            self::$_apiKey = $apiKey;
        }

        // ######################################

        /**
         * @return string
         */
        protected static function _getApiKey()
        {
            return (string)self::$_apiKey;
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
            $curl = \CURL::init(StripeApiConstants::URL_API_ROOT . $pathMethod)
                ->setHttpAuth(CURLAUTH_BASIC)
                ->setUserPwd(self::_getApiKey() . ":")
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

                if (isset($response['error']))
                {
                    $error = $response['error'];

                    if ((string)$error['type'] === 'api_error')
                    {
                        $code = PaymentExceptionConstants::ERR_API_CODE;
                        $message = PaymentExceptionConstants::ERR_API_MESSAGE;
                        unset($error['type']);
                    }

                    elseif ((string)$error['type'] === 'invalid_request_error')
                    {
                        $code = PaymentExceptionConstants::ERR_REQUEST_CODE;
                        $message = PaymentExceptionConstants::ERR_REQUEST_MESSAGE;
                        unset($error['type']);
                    }

                    elseif ((string)$error['type'] === 'card_error')
                    {
                        $code = PaymentExceptionConstants::ERR_PAYMENT_DATA_CODE;
                        $message = PaymentExceptionConstants::ERR_PAYMENT_DATA_MESSAGE;
                        unset($error['type']);
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
         * @param array $placeholder
         * @param array $postData
         *
         * @return bool|mixed
         */
        public static function create($pathMethod, array $placeholder, array $postData)
        {
            if (!empty($placeholder))
            {
                $pathMethod = self::_parsePathPlaceholders($pathMethod, $placeholder);
            }

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