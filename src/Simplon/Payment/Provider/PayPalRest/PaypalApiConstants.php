<?php

    namespace Simplon\Payment\Provider\PaypalRest;

    class PaypalApiConstants
    {
        CONST URL_API_ROOT_SANDBOX = 'https://api.sandbox.paypal.com/v1';
        CONST URL_API_ROOT_LIVE = 'https://api.paypal.com/v1';

        // ######################################

        CONST PAYMENT_METHOD_PAYPAL = 'paypal';
        CONST PAYMENT_METHOD_CREDIT_CARD = 'credit_card';

        // ######################################

        CONST PATH_OAUTH_TOKEN = '/oauth2/token';

        // ######################################

        CONST PATH_PAYMENTS_CREATE = '/payments/payment';
        CONST PATH_PAYMENTS_RETRIEVE = '/payments/payment/{{paymentId}}';
        CONST PATH_PAYMENTS_EXECUTE = '/payments/payment/{{paymentId}}/execute';

        // ######################################

        CONST PATH_SALES_RETRIEVE = '/payments/sale/{{saleId}}';
        CONST PATH_SALES_REFUND = '/payments/sale/{{saleId}}/refund';

        // ######################################

        CONST PATH_REFUNDS_RETRIEVE = '/payments/refund/{{refundId}}';
    }