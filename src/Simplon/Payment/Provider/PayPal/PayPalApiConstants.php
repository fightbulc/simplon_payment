<?php

    namespace Simplon\Payment\Provider\Paypal;

    class PaypalApiConstants
    {
        CONST URL_API_ROOT_SANDBOX = 'https://api.sandbox.paypal.com/v1';
        CONST URL_API_ROOT_LIVE = 'https://api.paypal.com/v1';

        CONST PATH_OAUTH_TOKEN = '/oauth2/token';

        CONST PATH_PAYMENTS_CREATE = '/payments/payment';
        CONST PATH_PAYMENTS_RETRIEVE = '/payments/payment/{{paymentId}}';
        CONST PATH_PAYMENTS_EXECUTE = '/payments/payment/{{paymentId}}/execute';
    }