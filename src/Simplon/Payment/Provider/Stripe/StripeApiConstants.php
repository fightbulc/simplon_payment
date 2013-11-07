<?php

    namespace Simplon\Payment\Provider\Stripe;

    class StripeApiConstants
    {
        CONST URL_API_ROOT = 'https://api.stripe.com/v1';

        CONST PATH_CUSTOMER_RETRIEVE_ALL = '/customers';
        CONST PATH_CUSTOMER_RETRIEVE = '/customers/{{customerId}}';
        CONST PATH_CUSTOMER_CREATE = '/customers';
        CONST PATH_CUSTOMER_UPDATE = '/customers/{{customerId}}';
        CONST PATH_CUSTOMER_DELETE = '/customers/{{customerId}}';

        CONST PATH_CARDS_RETRIEVE_ALL = '/customers/{{customerId}}/cards';
        CONST PATH_CARDS_RETRIEVE = '/customers/{{customerId}}/cards/{{cardId}}';
        CONST PATH_CARDS_CREATE = '/customers/{{customerId}}/cards';
        CONST PATH_CARDS_UPDATE = '/customers/{{customerId}}/cards/{{cardId}}';
        CONST PATH_CARDS_DELETE = '/customers/{{customerId}}/cards/{{cardId}}';

        CONST PATH_CHARGES_RETRIEVE = '/charges/{{chargeId}}';
        CONST PATH_CHARGES_CREATE = '/charges';
    }