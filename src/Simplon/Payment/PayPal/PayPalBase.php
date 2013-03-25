<?php

    namespace Simplon\Payment\PayPal;

    abstract class PayPalBase
    {
        /** @var Auth */
        protected $_authInstance;

        /** @var bool */
        protected $_sandboxMode = FALSE;

        /** @var string */
        protected $_apiVersion = '94.0'; // https://www.paypalobjects.com/wsdl/PayPalSvc.wsdl

        /** @var string */
        protected $_urlApi = 'https://api-3t.paypal.com/nvp';

        /** @var string */
        protected $_urlApiSandbox = 'https://api-3t.sandbox.paypal.com/nvp';

        /** @var string */
        protected $_checkoutToken;

        // ##########################################

        public function __construct(Auth $authInstance)
        {
            $this->_setAuth($authInstance);
        }

        // ##########################################

        /**
         * @param $message
         * @throws \Exception
         */
        protected function _throwException($message)
        {
            throw new \Exception(__NAMESPACE__ . '\\' . __CLASS__ . ': ' . $message, 500);
        }

        // ##########################################

        /**
         * @param Auth $authClass
         * @return PayPalBase
         */
        protected function _setAuth(Auth $authClass)
        {
            $this->_authInstance = $authClass;

            return $this;
        }

        // ##########################################

        /**
         * @return Auth
         */
        protected function _getAuthInstance()
        {
            $auth = $this->_authInstance;

            if(! isset($auth))
            {
                $this->_throwException('Missing authentication credentials.');
            }

            return $auth;
        }

        // ##########################################

        /**
         * @return \CURL
         */
        protected function _getCurlClass()
        {
            return new \CURL();
        }

        // ##########################################

        /**
         * @param $number
         * @return float
         */
        protected function _roundNumber($number)
        {
            return round($number, 2);
        }

        // ##########################################

        /**
         * @param $version
         * @return PayPalBase
         */
        public function setApiVersion($version)
        {
            $this->_apiVersion = $version;

            return $this;
        }

        // ##########################################

        /**
         * @return string
         */
        protected function _getApiVersion()
        {
            return $this->_apiVersion;
        }

        // ##########################################

        /**
         * @param $token
         * @return PayPalBase|PayPalProcess
         */
        public function setCheckoutToken($token)
        {
            if(empty($token))
            {
                $this->_throwException('setCheckoutToken failed due to empty token.');
            }

            $this->_checkoutToken = $token;

            return $this;
        }

        // ##########################################

        /**
         * @return string
         */
        public function getCheckoutToken()
        {
            return $this->_checkoutToken;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getAuthCredentials()
        {
            $authInstance = $this->_getAuthInstance();

            return array(
                'USER'      => $authInstance->getUsername(),
                'PWD'       => $authInstance->getPassword(),
                'SIGNATURE' => $authInstance->getSignature(),
                'VERSION'   => $this->_getApiVersion(),
            );
        }

        // ##########################################

        /**
         * @return string
         */
        protected function _getUrlApi()
        {
            $isSandbox = $this
                ->_getAuthInstance()
                ->isSandboxMode();

            if($isSandbox)
            {
                return $this->_urlApiSandbox;
            }

            return $this->_urlApi;
        }
    }
