<?php

  namespace Simplon\Payment\PayPal;

  use Simplon\Payment\PayPal\Vo\SetExpressCheckoutResponseVo;
  use Simplon\Payment\ProductItem;

  class PayPalStart extends PayPalBase
  {
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

    /** @var float */
    protected $_orderSubTotal = 0.00;

    /** @var float */
    protected $_orderTax = 0.00;

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
    protected $_urlPayPalLogin = 'https://www.paypal.com/cgi-bin/webscr?';

    /** @var string */
    protected $_urlPayPalLoginSandbox = 'https://www.sandbox.paypal.com/cgi-bin/webscr?';

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

    // ##########################################

    /**
     * @param $action
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
    protected function _getUrlPayPalLogin()
    {
      $isSandbox = $this
        ->_getAuthInstance()
        ->isSandboxMode();

      if($isSandbox)
      {
        return $this->_urlPayPalLoginSandbox;
      }

      return $this->_urlPayPalLogin;
    }

    // ##########################################

    /**
     * @param $pageStyleName
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @param $price
     * @return $this
     */
    public function setOrderSubTotal($price)
    {
      $this->_orderSubTotal = $price;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    protected function _getOrderSubTotal()
    {
      return $this->_orderSubTotal;
    }

    // ##########################################

    /**
     * @param $tax
     * @return $this
     */
    public function setOrderTax($tax)
    {
      $this->_orderTax = $tax;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    protected function _getOrderTax()
    {
      return $this->_orderTax;
    }

    // ##########################################

    /**
     * @param $items
     * @return $this
     */
    public function setOrderItemsMany($items)
    {
      $this->_orderItems = $items;

      return $this;
    }

    // ##########################################

    /**
     * @param \Simplon\Payment\ProductItem $item
     * @return $this
     */
    public function addOrderItem(ProductItem $item)
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

      if(! empty($orderItems))
      {
        // render item fields, items subtotal and tax total
        foreach($orderItems as $k => $itemClass)
        {
          /** @var $itemClass ProductItem */
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
      }

      return TRUE;
    }

    // ##########################################

    /**
     * @param $preparedItem
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return float
     */
    protected function _getOrderTaxTotal()
    {
      return $this->_roundNumber($this->_getOrderItemsTaxTotal() + $this->_getOrderTax());
    }

    // ##########################################

    /**
     * @param $bool
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
      $totalAmount = $this->_getOrderSubTotal() + $this->_getOrderItemsSubTotal() + $this->_getOrderItemsTaxTotal() + $this->_getShippingAmount() + $this->_getHandlingAmount() + $this->_getInsuranceAmount();

      // deduct shipping discount
      $totalAmount = $totalAmount - $this->_getShippingDiscount();

      // format and return
      return $this->_roundNumber($totalAmount);
    }

    // ##########################################

    /**
     * @param null $checkoutToken
     * @param bool $commitOnPayPal
     * @return string
     */
    public function createUrlPayPalLoginByCheckoutToken($checkoutToken = NULL, $commitOnPayPal = FALSE)
    {
      $data = array(
        'cmd'   => '_express-checkout',
        'token' => $checkoutToken,
      );

      // complete order on paypal?
      if($commitOnPayPal !== FALSE)
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
     * @return string
     */
    public function getUrlPayPalLogin()
    {
      return $this->createUrlPayPalLoginByCheckoutToken($this->getCheckoutToken(), $this->_isCommitOnPayPal());
    }

    // ##########################################

    /**
     * @return $this
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

      if(! empty($preparedOrderItems))
      {
        $postData['PAYMENTREQUEST_0_ITEMAMT'] = $this->_getOrderItemsSubTotal();
        $postData['PAYMENTREQUEST_0_TAXAMT'] = $this->_getOrderTaxTotal();

        foreach($preparedOrderItems as $item)
        {
          $postData = array_merge($postData, $item);
        }
      }

      // add auth credentials
      $authCredentials = $this->_getAuthCredentials();
      $postData = array_merge($postData, $authCredentials);

      // get token from paypal
      $token = $this->_requestCheckoutToken($postData);
      $this->setCheckoutToken($token);

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
        ->init($this->_getUrlApi())
        ->setPost(TRUE)
        ->setPostFields($postDataQuery)
        ->setReturnTransfer(TRUE)
        ->execute();

      /** @var $setExpressCheckoutResponseVo SetExpressCheckoutResponseVo */
      $setExpressCheckoutResponseVo = SetExpressCheckoutResponseVo::init($response);

      // throw exception on fail
      if($setExpressCheckoutResponseVo->isSuccess() === FALSE)
      {
        $this->_throwException('requestCheckoutToken failed with errors: ' . $setExpressCheckoutResponseVo->getErrors());
      }

      // all cool; return token
      return $setExpressCheckoutResponseVo->getToken();
    }
  }
