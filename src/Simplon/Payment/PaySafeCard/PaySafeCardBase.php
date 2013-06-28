<?php

    namespace Simplon\Payment\PaySafeCard;

    /**
     * Class PaySafeCardBase
     * @package Simplon\Payment\PaySafeCard
     */
    class PaySafeCardBase
    {
        protected $_endPoint = 'https://soatest.paysafecard.com/psc/services/PscService?wsdl';
        protected $_clientPanelRedurectUrl = 'https://customer.test.at.paysafecard.com/psccustomer/GetCustomerPanelServlet';
    }