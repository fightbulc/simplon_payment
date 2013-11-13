<?php

    namespace Simplon\Payment\Provider\PaypalAdaptive;

    class PaypalApiConstants
    {
        CONST URL_API_ROOT_SANDBOX = 'https://svcs.sandbox.paypal.com/AdaptivePayments/PaymentDetails';
        CONST URL_API_ROOT_LIVE = 'https://svcs.paypal.com/AdaptivePayments/PaymentDetails';

        CONST PATH_PAYMENT_DETAILS_RETRIEVE = '/AdaptivePayments/PaymentDetails';
    }