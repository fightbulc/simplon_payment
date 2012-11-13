<?php

  namespace Simplon\Payment\Providers\PayPal;

  class PayPal
  {
    /** @var Auth */
    protected $_authInstance;

    /** @var bool */
    protected $_sandboxMode = FALSE;

    /** @var string */
    protected $_apiVersion = '94.0'; // https://www.paypalobjects.com/wsdl/PayPalSvc.wsdl

    /** @var string */
    protected $_paymentAction = 'Sale';

    /** @var array */
    protected $_orderItems = array();

    /** @var array */
    protected $_orderItemsPrepared = array();

    /** @var float */
    protected $_orderItemsSubTotal = 0.00;

    /** @var float */
    protected $_orderItemsTaxTotal = 0.00;

    /** @var int */
    protected $_noShipping = 0;

    /** @var float */
    protected $_shippingAmount = 0.00;

    /** @var float */
    protected $_shippingDiscount = 0.00;

    /** @var float */
    protected $_handlingAmount = 0.00;

    /** @var float */
    protected $_insuranceAmount = 0.00;

    /** @var string */
    protected $_currencyCode = 'USD';

    /** @var string */
    protected $_urlSuccess;

    /** @var string */
    protected $_urlCancel;

    /** @var string */
    protected $_urlGetCheckoutTokenSandbox = 'https://api-3t.sandbox.paypal.com/nvp';

    /** @var string */
    protected $_urlGetCheckoutToken = 'https://api-3t.paypal.com/nvp';

    /** @var string */
    protected $_urlPayPalLogin = 'https://www.sandbox.paypal.com/cgi-bin/webscr?';

    /** @var null */
    protected $_pageStyleName = NULL;

    /** @var null */
    protected $_customLogoImage = NULL;

    /** @var null */
    protected $_customBorderColor = NULL;

    /** @var string */
    protected $_localeCode = 'US';

    /** @var array */
    protected $_validLocaleCodes = array(
      'AU' => 'Australia',
      'AT' => 'Austria',
      'BE' => 'Belgium',
      'BR' => 'Brazil',
      'CA' => 'Canada',
      'CH' => 'Switzerland',
      'CN' => 'China',
      'DE' => 'Germany',
      'ES' => 'Spain',
      'GB' => 'United Kingdom',
      'FR' => 'France',
      'IT' => 'Italy',
      'NL' => 'Netherlands',
      'PL' => 'Poland',
      'PT' => 'Portugal',
      'RU' => 'Russia',
      'US' => 'United States',
    );

    /** @var bool */
    protected $_isCommitOnPayPal = FALSE;

    /** @var string */
    protected $_checkoutToken;

    // ##########################################

    public function __construct(Auth $authInstance)
    {
      $this->_setAuth($authInstance);
    }

    // ##########################################

    /**
     * @param $message
     * @throws \Exception
     */
    protected function _throwException($message)
    {
      throw new \Exception(__NAMESPACE__ . '\\' . __CLASS__ . ': ' . $message, 500);
    }

    // ##########################################

    /**
     * @param $authClass
     * @return PayPal
     */
    protected function _setAuth(Auth $authClass)
    {
      $this->_authInstance = $authClass;

      return $this;
    }

    // ##########################################

    /**
     * @return Auth
     */
    protected function _getAuthInstance()
    {
      $auth = $this->_authInstance;

      if(! isset($auth))
      {
        $this->_throwException('Missing authentication credentials.');
      }

      return $auth;
    }

    // ##########################################

    /**
     * @return \CURL
     */
    protected function _getCurlClass()
    {
      return new \CURL();
    }

    // ##########################################

    /**
     * @param $number
     * @return float
     */
    protected function _roundNumber($number)
    {
      return round($number, 2);
    }

    // ##########################################

    /**
     * @param $version
     * @return PayPal
     */
    public function setApiVersion($version)
    {
      $this->_apiVersion = $version;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getApiVersion()
    {
      return $this->_apiVersion;
    }

    // ##########################################

    /**
     * @param bool $bool
     * @return PayPal
     */
    public function enableSandboxMode($bool = FALSE)
    {
      $this->_sandboxMode = $bool !== FALSE ? TRUE : FALSE;

      return $this;
    }

    // ##########################################

    /**
     * @return bool
     */
    protected function _isSandboxMode()
    {
      return $this->_sandboxMode;
    }

    // ##########################################

    /**
     * @param $action
     * @return PayPal
     */
    public function setPaymentAction($action)
    {
      $this->_paymentAction = $action;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getPaymentAction()
    {
      return $this->_paymentAction;
    }

    // ##########################################

    /**
     * @param $bool
     * @return PayPal
     */
    public function setCommitOnPayPal($bool)
    {
      $this->_isCommitOnPayPal = $bool;

      return $this;
    }

    // ##########################################

    /**
     * @return bool
     */
    protected function _isCommitOnPayPal()
    {
      return $this->_isCommitOnPayPal !== FALSE;
    }

    // ##########################################

    /**
     * @param $code
     * @return PayPal
     */
    public function setCurrencyCode($code)
    {
      $this->_currencyCode = $code;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getCurrencyCode()
    {
      return $this->_currencyCode;
    }

    // ##########################################

    /**
     * @param $code
     * @return PayPal
     */
    public function setLocaleCode($code)
    {
      $code = strtoupper($code);

      if(! isset($this->_validLocaleCodes[$code]))
      {
        $code = 'US';
      }

      $this->_localeCode = $code;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getLocaleCode()
    {
      return $this->_localeCode;
    }

    // ##########################################

    /**
     * @param $url
     * @return PayPal
     */
    public function setUrlSuccess($url)
    {
      $this->_urlSuccess = $url;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getUrlSuccess()
    {
      return $this->_urlSuccess;
    }

    // ##########################################

    /**
     * @param $url
     * @return PayPal
     */
    public function setUrlCancel($url)
    {
      $this->_urlCancel = $url;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getUrlCancel()
    {
      return $this->_urlCancel;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getUrlGetCheckoutToken()
    {
      if($this->_isSandboxMode())
      {
        return $this->_urlGetCheckoutTokenSandbox;
      }

      return $this->_urlGetCheckoutToken;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getUrlPayPalLogin()
    {
      return $this->_urlPayPalLogin;
    }

    // ##########################################

    /**
     * @param $pageStyleName
     * @return PayPal
     */
    public function setPageStyle($pageStyleName)
    {
      $this->_pageStyleName = $pageStyleName;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getPageStyle()
    {
      return $this->_pageStyleName;
    }

    // ##########################################

    /**
     * @param $url
     * @return PayPal
     */
    public function setCustomLogoImage($url)
    {
      $this->_customLogoImage = $url;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getCustomLogoImage()
    {
      return $this->_customLogoImage;
    }

    // ##########################################

    /**
     * @param $hexColor
     * @return PayPal
     */
    public function setCustomBorderColor($hexColor)
    {
      $this->_customBorderColor = $hexColor;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    protected function _getCustomBorderColor()
    {
      return $this->_customBorderColor;
    }

    // ##########################################

    /**
     * @param $items
     * @return PayPal
     */
    public function setOrderItemsMany($items)
    {
      $this->_orderItems = $items;

      return $this;
    }

    // ##########################################

    /**
     * @param Item $item
     * @return PayPal
     */
    public function addOrderItem(Item $item)
    {
      $this->_orderItems[] = $item;

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getOrderItems()
    {
      return $this->_orderItems;
    }

    // ##########################################

    /**
     * @return bool
     */
    protected function _prepareOrderItems()
    {
      $orderItems = $this->_getOrderItems();

      // we can't go on without any items
      if(empty($orderItems))
      {
        $this->_throwException('No order items have been defined.');
      }

      // render item fields, items subtotal and tax total
      foreach($orderItems as $k => $itemClass)
      {
        /** @var $itemClass Item */
        $item = array(
          'L_PAYMENTREQUEST_0_NAME' . $k   => $itemClass->getName(),
          'L_PAYMENTREQUEST_0_DESC' . $k   => $itemClass->getDescription(),
          'L_PAYMENTREQUEST_0_NUMBER' . $k => $itemClass->getRefId(),
          'L_PAYMENTREQUEST_0_AMT' . $k    => $itemClass->getPrice(),
          'L_PAYMENTREQUEST_0_QTY' . $k    => $itemClass->getQuantity(),
        );

        // add to prepared items
        $this->_addPreparedOrderItem($item);

        // add to items sub total
        $this->_addOrderItemsSubTotal($itemClass->getPrice(), $itemClass->getQuantity());

        // add to tax total
        $this->_addOrderItemsTaxTotal($itemClass->getPrice(), $itemClass->getQuantity(), $itemClass->getTax());
      }

      return TRUE;
    }

    // ##########################################

    /**
     * @param $preparedItem
     * @return PayPal
     */
    protected function _addPreparedOrderItem($preparedItem)
    {
      $this->_orderItemsPrepared[] = $preparedItem;

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getPreparedOrderItems()
    {
      return $this->_orderItemsPrepared;
    }

    // ##########################################

    /**
     * @param $itemPrice
     * @param $quantity
     * @return PayPal
     */
    protected function _addOrderItemsSubTotal($itemPrice, $quantity)
    {
      $this->_orderItemsSubTotal += $itemPrice * $quantity;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    protected function _getOrderItemsSubTotal()
    {
      return $this->_roundNumber($this->_orderItemsSubTotal);
    }

    // ##########################################

    /**
     * @param $itemPrice
     * @param $quantity
     * @param $taxPercentage
     * @return PayPal
     */
    protected function _addOrderItemsTaxTotal($itemPrice, $quantity, $taxPercentage)
    {
      $tax = ($itemPrice * $quantity) * ($taxPercentage / 100);
      $this->_orderItemsTaxTotal += $tax;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    protected function _getOrderItemsTaxTotal()
    {
      return $this->_roundNumber($this->_orderItemsTaxTotal);
    }

    // ##########################################

    /**
     * @param $bool
     * @return PayPal
     */
    public function setNoShipping($bool = FALSE)
    {
      $this->_noShipping = (bool)$bool === TRUE ? 1 : 0;

      return $this;
    }

    // ##########################################

    /**
     * @return int
     */
    protected function _getNoShipping()
    {
      return $this->_noShipping;
    }

    // ##########################################

    /**
     * @param $cost
     * @return PayPal
     */
    public function setShippingAmount($cost)
    {
      $this->_shippingAmount = $cost;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    protected function _getShippingAmount()
    {
      return $this->_roundNumber($this->_shippingAmount);
    }

    // ##########################################

    /**
     * @param $cost
     * @return PayPal
     */
    public function setShippingDiscount($cost)
    {
      $this->_shippingDiscount = $cost;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    protected function _getShippingDiscount()
    {
      return $this->_roundNumber($this->_shippingDiscount);
    }

    // ##########################################

    /**
     * @param $cost
     * @return PayPal
     */
    public function setHandlingAmount($cost)
    {
      $this->_handlingAmount = $cost;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    protected function _getHandlingAmount()
    {
      return $this->_roundNumber($this->_handlingAmount);
    }

    // ##########################################

    /**
     * @param $cost
     * @return PayPal
     */
    public function setInsuranceAmount($cost)
    {
      $this->_insuranceAmount = $cost;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    protected function _getInsuranceAmount()
    {
      return $this->_roundNumber($this->_insuranceAmount);
    }

    // ##########################################

    /**
     * @return float
     */
    public function getOrderTotalAmount()
    {
      // add amounts together
      $totalAmount = $this->_getOrderItemsSubTotal() + $this->_getOrderItemsTaxTotal() + $this->_getShippingAmount() + $this->_getHandlingAmount() + $this->_getInsuranceAmount();

      // deduct shipping discount
      $totalAmount = $totalAmount - $this->_getShippingDiscount();

      // format and return
      return $this->_roundNumber($totalAmount);
    }

    // ##########################################

    /**
     * @return string
     */
    public function getUrlPayPalLogin()
    {
      $data = array(
        'cmd'   => '_express-checkout',
        'token' => $this->getCheckoutToken(),
      );

      // complete order on paypal?
      if($this->_isCommitOnPayPal())
      {
        $data['useraction'] = 'commit';
      }

      // build query
      $query = http_build_query($data);

      // return url
      return $this->_getUrlPayPalLogin() . $query;
    }

    // ##########################################

    /**
     * @param $token
     * @return PayPal
     */
    protected function _setCheckoutToken($token)
    {
      if(empty($token))
      {
        $this->_throwException('setCheckoutToken failed due to empty token.');
      }

      $this->_checkoutToken = $token;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    public function getCheckoutToken()
    {
      return $this->_checkoutToken;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getAuthCredentials()
    {
      $authClass = $this->_getAuthInstance();

      return array(
        'USER'      => $authClass->getApiUsername(),
        'PWD'       => $authClass->getApiPassword(),
        'SIGNATURE' => $authClass->getApiSignature(),
        'VERSION'   => $this->_getApiVersion(),
      );
    }

    // ##########################################

    /**
     * @return PayPal
     */
    public function requestCheckoutToken()
    {
      // prepare item data
      $this->_prepareOrderItems();

      // set post data
      $postData = array(
        /**
         * indicates init checkout
         */
        'METHOD'                         => 'SetExpressCheckout',
        /**
         * payment details
         */
        'PAYMENTREQUEST_0_PAYMENTACTION' => $this->_getPaymentAction(),
        'PAYMENTREQUEST_0_ITEMAMT'       => $this->_getOrderItemsSubTotal(),
        'PAYMENTREQUEST_0_TAXAMT'        => $this->_getOrderItemsTaxTotal(),
        'PAYMENTREQUEST_0_SHIPPINGAMT'   => $this->_getShippingAmount(),
        'PAYMENTREQUEST_0_SHIPDISCAMT'   => $this->_getShippingDiscount(),
        'PAYMENTREQUEST_0_HANDLINGAMT'   => $this->_getHandlingAmount(),
        'PAYMENTREQUEST_0_INSURACEAMT'   => $this->_getInsuranceAmount(),
        'PAYMENTREQUEST_0_AMT'           => $this->getOrderTotalAmount(),
        'PAYMENTREQUEST_0_CURRENCYCODE'  => $this->_getCurrencyCode(),
        /**
         * shipping on/off
         */
        'NOSHIPPING'                     => $this->_getNoShipping(),
        /**
         * set locale and follow-up urls
         */
        'LOCALECODE'                     => $this->_getLocaleCode(),
        'RETURNURL'                      => $this->_getUrlSuccess(),
        'CANCELURL'                      => $this->_getUrlCancel(),
        /**
         * custom styles
         */
        'PAGESTYLE'                      => $this->_getPageStyle(),
        'LOGOIMG'                        => $this->_getCustomLogoImage(),
        'CARTBORDERCOLOR'                => $this->_getCustomBorderColor(),
      );

      // add prepared order items
      $preparedOrderItems = $this->_getPreparedOrderItems();

      foreach($preparedOrderItems as $item)
      {
        $postData = array_merge($postData, $item);
      }

      // add auth credentials
      $authCredentials = $this->_getAuthCredentials();
      $postData = array_merge($postData, $authCredentials);

      // get token from paypal
      $token = $this->_requestCheckoutToken($postData);
      $this->_setCheckoutToken($token);

      return $this;
    }

    // ##########################################

    /**
     * @param $postData
     * @return bool|mixed
     */
    protected function _requestCheckoutToken($postData)
    {
      // build query string
      $postDataQuery = http_build_query($postData);

      // call paypal
      $response = $this
        ->_getCurlClass()
        ->init($this->_getUrlGetCheckoutToken())
        ->setPost(TRUE)
        ->setPostFields($postDataQuery)
        ->setReturnTransfer(TRUE)
        ->execute();

      /** @var $tokenResponseVo \Simplon\Payment\Providers\PayPal\Vo\TokenResponseVo */
      $tokenResponseVo = \Simplon\Payment\Providers\PayPal\Vo\TokenResponseVo::init($response);

      // throw exception on fail
      if($tokenResponseVo->isSuccess() === FALSE)
      {
        $this->_throwException('requestCheckoutToken failed with errors: ' . $tokenResponseVo->getErrors());
      }

      // all cool; return token
      return $tokenResponseVo->getToken();
    }

    // ##########################################

    /**
     * @param $checkoutToken
     * @return Vo\DetailsResponseVo
     */
    public function requestCheckoutDetails($checkoutToken)
    {
      // set post data
      $postData = array(
        'METHOD' => 'GetExpressCheckoutDetails',
        'TOKEN'  => $checkoutToken,
      );

      // add auth credentials
      $authCredentials = $this->_getAuthCredentials();
      $postData = array_merge($postData, $authCredentials);

      return $this->_requestCheckoutDetails($postData);
    }

    // ##########################################

    /**
     * @param $postData
     * @return Vo\DetailsResponseVo
     */
    protected function _requestCheckoutDetails($postData)
    {
      // build query string
      $postDataQuery = http_build_query($postData);

      // call paypal
      $response = $this
        ->_getCurlClass()
        ->init($this->_getUrlGetCheckoutToken())
        ->setPost(TRUE)
        ->setPostFields($postDataQuery)
        ->setReturnTransfer(TRUE)
        ->execute();

      /** @var $detailsResponseVo \Simplon\Payment\Providers\PayPal\Vo\DetailsResponseVo */
      $detailsResponseVo = \Simplon\Payment\Providers\PayPal\Vo\DetailsResponseVo::init($response);

      // throw exception on fail
      if($detailsResponseVo->isSuccess() === FALSE)
      {
        $this->_throwException('requestCheckoutDetails failed with errors: ' . $detailsResponseVo->getErrors());
      }

      // all cool; return token
      return $detailsResponseVo;
    }

    // ##########################################

    /**
     * @param $checkoutToken
     * @param $payerId
     * @param $orderAmount
     * @return Vo\PaymentResponseVo
     */
    public function requestCheckoutPayment($checkoutToken, $payerId, $orderAmount)
    {
      // set post data
      $postData = array(
        'METHOD'                         => 'DoExpressCheckoutPayment',
        'PAYMENTREQUEST_0_PAYMENTACTION' => 'Authorization',
        'TOKEN'                          => $checkoutToken,
        'PAYERID'                        => $payerId,
        'PAYMENTREQUEST_0_AMT'           => $orderAmount,
      );

      // add auth credentials
      $authCredentials = $this->_getAuthCredentials();
      $postData = array_merge($postData, $authCredentials);

      return $this->_requestCheckoutPayment($postData);
    }

    // ##########################################

    /**
     * @param $postData
     * @return Vo\PaymentResponseVo
     */
    protected function _requestCheckoutPayment($postData)
    {
      // build query string
      $postDataQuery = http_build_query($postData);

      // call paypal
      $response = $this
        ->_getCurlClass()
        ->init($this->_getUrlGetCheckoutToken())
        ->setPost(TRUE)
        ->setPostFields($postDataQuery)
        ->setReturnTransfer(TRUE)
        ->execute();

      /** @var $paymentResponseVo \Simplon\Payment\Providers\PayPal\Vo\PaymentResponseVo */
      $paymentResponseVo = \Simplon\Payment\Providers\PayPal\Vo\PaymentResponseVo::init($response);

      // throw exception on fail
      if($paymentResponseVo->isSuccess() === FALSE)
      {
        $this->_throwException('requestCheckoutPayment failed with errors: ' . $paymentResponseVo->getErrors());
      }

      // all cool; return token
      return $paymentResponseVo;
    }
  }
