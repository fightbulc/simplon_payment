<?php

    namespace Simplon\Payment\PaySafeCard;

    /**
     * Class PaySafeCardBase
     * @package Simplon\Payment\PaySafeCard
     */
    class PaySafeCardBase
    {
        protected $_endPoint = 'https://soat.paysafecard.com/psc/services/PscService?wsdl';
        protected $_clientPanelRedurectUrl = 'https://customer.cc.at.paysafecard.com/psccustomer/GetCustomerPanelServlet';
    }