<?php

    namespace Simplon\Payment;

    class PaymentExceptionConstants
    {
        CONST ERR_API_CODE = 1;
        CONST ERR_API_MESSAGE = 'Provider says: API error';

        CONST ERR_REQUEST_CODE = 2;
        CONST ERR_REQUEST_MESSAGE = 'Provider says: invalid request';

        CONST ERR_PAYMENT_DATA_CODE = 3;
        CONST ERR_PAYMENT_DATA_MESSAGE = 'Provider says: invalid payment data';

        CONST ERR_UNKNOWN_CODE = 4;
        CONST ERR_UNKNOWN_MESSAGE = 'Provider says: unknown error - see response data';
    }