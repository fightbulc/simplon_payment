<?php

    namespace Simplon\Payment;

    class PaymentHelper
    {
        /**
         * @param $message
         * @param null $expectedValue
         * @param null $givenValue
         *
         * @return string
         */
        public static function createErrorMessage($message, $expectedValue = NULL, $givenValue = NULL)
        {
            $message = 'Message: "' . $message . '"';

            if ($expectedValue !== NULL && $givenValue !== NULL)
            {
                $message = $message . ' | Expected value: "' . $expectedValue . '". Given value: "' . $givenValue . '"';
            }

            return $message;
        }

        // ######################################

        /**
         * @param $a
         * @param $b
         *
         * @return bool
         */
        public static function isStringEqual($a, $b)
        {
            return strtoupper($a) === strtoupper($b) ? TRUE : FALSE;
        }

        // ######################################

        /**
         * @param $a
         * @param $b
         *
         * @return bool
         */
        public static function isIntegerEqual($a, $b)
        {
            return (int)$a === (int)$b ? TRUE : FALSE;
        }
    }