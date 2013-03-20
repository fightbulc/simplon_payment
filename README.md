<pre>
     _                 _             
 ___(_)_ __ ___  _ __ | | ___  _ __  
/ __| | '_ ` _ \| '_ \| |/ _ \| '_ \ 
\__ \ | | | | | | |_) | | (_) | | | |
|___/_|_| |_| |_| .__/|_|\___/|_| |_|
                |_|                  
                                        _   
 _ __   __ _ _   _ _ __ ___   ___ _ __ | |_ 
| '_ \ / _` | | | | '_ ` _ \ / _ \ '_ \| __|
| |_) | (_| | |_| | | | | | |  __/ | | | |_ 
| .__/ \__,_|\__, |_| |_| |_|\___|_| |_|\__|
|_|          |___/                          
</pre>

# Simplon Payment

Version 0.5.3

## Intro

Simplon Payment was built to host conform libraries for different payment service provider. At the moment of writing this module consist of two libraries: ```PayPal``` and ```Skrill```. Both libraries were created by applying the Builder Pattern.

Make sure to create test accounts for both libraries. [Setting up test accounts for PayPal is really easy](https://developer.paypal.com/).

Skrill is a bit more challenging. The setup for real- and test-accounts is the same. However, in order to activate an account as test-account you need to send an inquiry via email to the support. Include your account number. This takes some time. The easiest and fastest way though would be to contact your Skrill key account manager to handle the setup - provided that you have a key account manager.

## Install

You can install Simplon/Payment either via package download from github or via [Composer](http://getcomposer.org) install. I encourage you to do the latter:

```json
{
  "require": {
    "php": ">=5.4",
    "simplon/payment": "1.0.0"
  }
}
```

## Note

This documentation is work in progress. Therefore, in case of any questions have a look in to the code or drop me a message.

## PayPal

PayPal's checkout flow consists of three steps:

- Request checkout token (Response: session token)
- Request checkout details (Response: all payment details)
- Request checkout payment (Response: all payment details + transactionId)

### Requirements

PayPal demands for a set of authentication credentials which have to be registered with [PayPal's Merchant Service](https://www.paypal.com/webapps/mpp/selling-with-paypal). Upon successful registration the following credentials will be available:

- merchant username
- merchant password
- signature

### Request checkout token

PayPal requires always authentication which is handled by our ```Auth``` class:

```php
$authPayPal = \Simplon\Payment\PayPal\Auth::init()
  ->setUsername('MERCHANT_USER')
  ->setPassword('MERCHANT_PASSWORD')
  ->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31ApO9gj13zKmSBD2TGtEw8-whfzBW')
  ->setSandboxMode(TRUE); // for production = FALSE
```

Before we can send our request we need a product. This will be created by our ```ProductItem``` class. As you will see we can create more than just one product. All product items will be store in a simple array:

```php
$items = array();

// add item
$items[] = (new \Simplon\Payment\ProductItem())
  ->setRefId('12345')
  ->setName('Super Mega Pack')
  ->setDescription('500 Diamonds with 50% discount')
  ->setPrice(15)
  ->setQuantity(1)
  ->setTax(19);

// add item
$items[] = (new \Simplon\Payment\ProductItem())
  ->setName('Strong Hammer')
  ->setPrice(3.99)
  ->setQuantity(1);
```

Ok, lets finish this and request the ```checkoutToken```:

```php
// create instance of PayPalStart
$paypal = new \Simplon\Payment\PayPal\PayPalStart($authPayPal);

// request token
$paypal
  ->setOrderItemsMany($items)
  ->setUrlSuccess(URL_SUCCESS)
  ->setUrlCancel(URL_CANCEL)
  ->setCommitOnPayPal(TRUE)
  ->requestCheckoutToken();

// show token
echo $paypal->getCheckoutToken(); // prints checkoutToken
```

We don't get really far with the token alone. We actually need PayPal's store URL:

```php
$urlPayPalLogin = $paypalSession->getUrlPayPalLogin();
echo '<a href="' . $urlPayPalLogin . '" target="_blank">' . $urlPayPalLogin . '</a>';
```

Alright, this prints an anchor on our page which takes us to PayPal's store where we can enter our data.

### Request checkout details

Our next step takes action as soon as the user entered all at PayPal's end. When everything went fine PayPal will call our prior defined ```urlSuccess``` with a GET parameter ```$_GET['token']```. The script which is behind our ```urlSuccess``` should do the following to fetch the ```CheckoutDetails```:

```php
// auth
$authPayPal = \Simplon\Payment\PayPal\Auth::init(); // do the same as above ...

// create instance of PayPalProcess
$paypal = new \Simplon\Payment\PayPal\PayPalProcess($authPayPal);

// set received checkoutToken
$paypal->setCheckoutToken($_GET['token']);

// request checkout details based on checkoutToken
$paypal->requestGetExpressCheckoutDetails();

// get created VO
$detailsResponseVo = $paypalSession->getGetExpressCheckoutDetailsResponseVo();
```

The ```GetExpressCheckoutDetailsResponseVo()``` holds now all essential data from our call. Have a look at the class to see what else is available. The VO can be extended if necessary.

### Request checkout payment

That's the last step in order to finalise the checkout. To run this last request we need three values from our just filled VO ```GetExpressCheckoutDetailsResponseVo()```:

- ```$detailsResponseVo->getPayerId()```
- ```$detailsResponseVo->getOrderAmount()```
- ```$detailsResponseVo->getCurrencyCode()```

The order amount and the currency code have to match the values from our initial checkout request. Ok, lets assume we are still in the exact script as for our last example. Now, lets get some money:

```php
// here goes code for request checkout details ...

$paypal->requestDoExpressCheckoutPayment(
  $detailsResponseVo->getPayerId(),
  $detailsResponseVo->getOrderAmount(),
  $detailsResponseVo->getCurrencyCode()
);

// resonse data are within this VO
$paymentResponseVo = $paypalSession->getDoExpressCheckoutPaymentResponseVo();
```

If no exception occurs the checkout went through and we received some money. All what is left to conclude a PayPal checkout is to save the response data to a DB so that we have a persistent access.

## Skrill

Skrill's checkout flow has two steps:

- Request checkout token (Response: session token)
- Request checkout payment data (Response: all payment details + transactionId)

### Requirements

Skrill requires an active [merchant account](https://www.moneybookers.com/onboard/en/register.pl?scid=main_business) which will be referenced by the merchant's email address. Also, you need to make sure that all [payment methods](https://www.moneybookers.com/ads/merchant-account/payment-options/) are activated for your account. Credit cards require a special audit by Skrill.

In order to fetch all final checkout data we need to use Skrill's ```Merchant Query Interface (MQI)```. For that we need a password which needs to be defined at your merchant account.

### Request checkout token

When it comes to authentication Skrill only demands the merchant's email address. As for PayPal we also define our product via the ```ProductItem``` class and cache it to an array:

```php
$items = [];

$items[] = (new \Simplon\Payment\ProductItem())
  ->setRefId('12345')
  ->setName('Product A')
  ->setPrice(15.99)
  ->setQuantity(1);

$items[] = (new \Simplon\Payment\ProductItem())
  ->setRefId('678910')
  ->setName('Product B')
  ->setPrice(9.99)
  ->setQuantity(1);
```

Before we can request the checkout token we need to define which payment options we would like to offer to our customers. Since Skrill comes with quite some payment options, which differ by country, we need to find a way to easily define them. Well, lets use our ```Builder Pattern``` again:

```php
// create country payment methods instance
$enabledPaymentMethods = new \Simplon\Payment\Skrill\PaymentMethods\SkrillPaymentMethodsGermany();

// enable payment methods
$enabledPaymentMethods
  ->useBankSofortueberweisung()
  ->useBankOnlineBankTransfer()
  ->useCardVisa();
```

Ok, what happened here? First, we create an instance which has all possible payment options for ```Germany```. Then we enable the options ```Sofortueberweisung```, ```BankOnlineTransfer``` and ```Visa```.

Alright, now that we have all what is needed lets get the ```checkoutToken``` respectively the ```checkoutUrl```:

```php
// request checkoutToken
$skrill = (new \Simplon\Payment\Skrill\SkrillStart())
  ->setUrlReturn(URL_RETURN)
  ->setUrlCancel(URL_CANCEL)
  ->setUrlCallback(URL_CALLBACK)
  ->setMerchantAccountEmail(MERCHANT_EMAIL)
  ->setOrderTransactionId('8473d989-4ad0-4c83-b6e3-5cc0ed74a408')
  ->setOrderCurrency('EUR')
  ->setOrderItemsMany($items)                                  // our defined items array
  ->setOrderEnabledPaymentMethods($enabledPaymentMethods)      // our enabled options
  ->addOrderCustomCallbackData('customField1', 'customValue')  // add a custom field
  ->addOrderCustomCallbackData('customField2', 'customValue')  // another custom field
  ->addOrderCustomCallbackData('customField3', 'customValue')  // and so on...
  ->requestCheckoutToken();

// get checkoutUrl
$checkoutUrl = $skrill->getCheckoutUrl();
```

As we can see there are a couple of blanks we need to fill in:

- ```URL_RETURN```: Redirect URL upon successful data entry on Skrill's page
- ```URL_CANCEL```: Redirect URL upon cancel on Skrill's page
- ```URL_CALLBACK```: Callback URL upon successful booking. Receives all booking data via POST (optional)
- ```MERCHANT_EMAIL```: Email as defined in your merchant account

If all went fine we should receive a ```checkoutUrl```. Redirecting to this url shows Skrill's form page with all required fields.

Upon successful data entry and all confirmations on Skrill's page the user will be redirected to ```URL_RETURN```.

### Request checkout payment data

If we defined a ```URL_CALLBACK``` Skrill will send us all booking data via ```POST```. From there on its up to us on how to process these data.

However, there is an alternative which allows us to fetch all booking data at any time which pleases us. For that we have to use the aforementioned ```Merchant Query Interface (MQI)``` in combination with our ```MERCHANT_EMAIL```, ```GATEWAY_PASSWORD``` and a ```TRANSACTION_ID```:

```php
// credentials
$merchantAccountEmail = "[MERCHANT_EMAIL]";
$merchantApiMqiPassword = "[MERCHANT_GATEWAY_PASSWORD]";
$merchantTransactionId = "[MERCHANT_TRANSACTION_ID]";

// request MQI
$checkoutQueryResponseVo = (new SkrillProcess())->getCheckoutDetailsByMerchantTransactionId(
  $merchantAccountEmail,
  $merchantApiMqiPassword,
  $merchantTransactionId
);

// $checkoutQueryResponseVo has access to the following methods:
$checkoutQueryResponseVo->getSkrillSha2Signature();
$checkoutQueryResponseVo->getSkrillMd5Signature();
$checkoutQueryResponseVo->getSkrillStatus();
$checkoutQueryResponseVo->getSkrillTransactionId();
$checkoutQueryResponseVo->getSkrillAmount();
$checkoutQueryResponseVo->getSkrillCurrency();
$checkoutQueryResponseVo->getSkrillMerchantId();
$checkoutQueryResponseVo->getPostedTransactionId();
$checkoutQueryResponseVo->getSkrillCustomerId();
$checkoutQueryResponseVo->getPostedAmount();
$checkoutQueryResponseVo->getPostedCurrency();
$checkoutQueryResponseVo->getSkrillPaymentType();
$checkoutQueryResponseVo->getPostedMerchantAccountEmail();
$checkoutQueryResponseVo->getSkrillPayFromEmail();

// fetch custom fields in case you added some to the checkout
$checkoutQueryResponseVo->getPostedCustomCallbackData();
```

With that example we have finished the checkout cycle for Skrill payments.
