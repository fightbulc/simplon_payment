<?php

    namespace Simplon\Payment\PaySafeCard;

    /**
     * Class PaySafeCardBase
     * @package Simplon\Payment\PaySafeCard
     */
    class PaySafeCardBase
    {
        protected $_username = 'psc_justagamegmbh_test';
        protected $_password = '9UB0FVUSDMAP6';
        protected $_mid = '1000004787';
        protected $_endPoint = 'https://soatest.paysafecard.com/psc/services/PscService?wsdl';
        protected $_okUrl = 'http://gws.kingsandlegends.local/checkout/response/';
        protected $_nokUrl = 'http://gws.kingsandlegends.local/checkout/cancel/';
        protected $_clientPanelRedurectUrl = 'https://customer.test.at.paysafecard.com/psccustomer/GetCustomerPanelServlet';

    }