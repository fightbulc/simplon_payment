<?php

    namespace Simplon\Payment;

    class PaymentException extends \Exception
    {
        /** @var null|array */
        protected $response;

        // ######################################

        public function __construct($code, $message, $response = NULL)
        {
            $this->message = $message;
            $this->code = $code;
            $this->response = $response;
        }

        // ######################################

        /**
         * @return array|null
         */
        public function getResponse()
        {
            return $this->response;
        }

        // ######################################

        /**
         * @return array
         */
        public function getData()
        {
            return [
                'code'     => $this->getCode(),
                'message'  => $this->getMessage(),
                'response' => $this->getResponse(),
            ];
        }
    }