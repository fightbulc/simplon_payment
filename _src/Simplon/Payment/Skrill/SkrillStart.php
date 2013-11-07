<?php

    namespace Simplon\Payment\Skrill;

    use Simplon\Payment\ProductItem;

    class SkrillStart extends SkrillBase
    {
        /**
         * @return bool
         */
        protected function _isPreparedOrder()
        {
            return $this->_usePreparedOrder;
        }

        // ##########################################

        /**
         * @param $hideLoginSection
         * @return $this
         */
        public function setHideLoginSection($hideLoginSection)
        {
            $this->_hideLoginSection = $hideLoginSection !== FALSE ? 1 : 0;

            return $this;
        }

        // ##########################################

        /**
         * @return int
         */
        protected function _isHideLoginSection()
        {
            return $this->_hideLoginSection;
        }

        // ##########################################

        /**
         * @param $merchantAccountEmail
         * @return $this
         */
        public function setMerchantAccountEmail($merchantAccountEmail)
        {
            $this->_merchantAccountEmail = $merchantAccountEmail;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getMerchantAccountEmail()
        {
            return $this->_merchantAccountEmail;
        }

        // ##########################################

        /**
         * @param $merchantName
         * @return $this
         */
        public function setMerchantName($merchantName)
        {
            $this->_merchantName = $merchantName;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getMerchantName()
        {
            return $this->_merchantName;
        }

        // ##########################################

        /**
         * @param $orderAffiliateId
         * @return $this
         */
        public function setOrderAffiliateId($orderAffiliateId)
        {
            $this->_orderAffiliateId = $orderAffiliateId;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderAffiliateId()
        {
            return $this->_orderAffiliateId;
        }

        // ##########################################

        /**
         * @param $orderAffiliateName
         * @return $this
         */
        public function setOrderAffiliateName($orderAffiliateName)
        {
            $this->_orderAffiliateName = $orderAffiliateName;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderAffiliateName()
        {
            return $this->_orderAffiliateName;
        }

        // ##########################################

        /**
         * @param ProductItem[] $items
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
         * @return ProductItem[]
         */
        protected function _getOrderItems()
        {
            return $this->_orderItems;
        }

        // ##########################################

        /**
         * @return float
         */
        protected function _getOrderAmount()
        {
            $orderItems = $this->_getOrderItems();

            if(count($orderItems))
            {
                foreach($orderItems as $item)
                {
                    $this->_orderAmount += $item->getPrice() * $item->getQuantity();
                }
            }

            return $this->_orderAmount;
        }

        // ##########################################

        /**
         * @param $name
         * @param $value
         * @return $this
         */
        public function addOrderCustomCallbackData($name, $value)
        {
            if(count($this->_orderCallbackData) <= 5)
            {
                $this->_orderCallbackData['custom_' . $name] = $value;
            }

            return $this;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getOrderCallbackData()
        {
            return $this->_orderCallbackData;
        }

        // ##########################################

        /**
         * @return string
         */
        protected function _getOrderMerchantFields()
        {
            $fieldNames = array_keys($this->_getOrderCallbackData());

            if(! empty($fieldNames))
            {
                return join(',', $fieldNames);
            }

            return '';
        }

        // ##########################################

        /**
         * @param $orderConfirmationNote
         * @return $this
         */
        public function setOrderConfirmationNote($orderConfirmationNote)
        {
            $this->_orderConfirmationNote = $orderConfirmationNote;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderConfirmationNote()
        {
            return $this->_orderConfirmationNote;
        }

        // ##########################################

        /**
         * @param $label
         * @param $value
         * @return $this
         */
        public function addOrderCostDescriptions($label, $value)
        {
            if(count($this->_orderCostDescriptions) <= 4)
            {
                $this->_orderCostDescriptions[] = [
                    'label' => $label,
                    'value' => $value,
                ];
            }

            return $this;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getOrderCostDescriptions()
        {
            return $this->_orderCostDescriptions;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getOrderCostDescriptionsPrepared()
        {
            $_prepared = [];

            if(count($this->_orderCostDescriptions) > 0)
            {
                foreach($this->_orderCostDescriptions as $index => $descriptionArray)
                {
                    $count = $index + 2;
                    $_prepared['amount' . $count . '_description'] = $descriptionArray['label'];
                    $_prepared['amount' . $count] = $descriptionArray['value'];
                }
            }

            return $_prepared;
        }

        // ##########################################

        /**
         * @param $orderCurrency
         * @return $this
         */
        public function setOrderCurrency($orderCurrency)
        {
            $orderCurrency = strtoupper($orderCurrency);

            if(array_key_exists($orderCurrency, $this->_getCurrenciesAvailable()))
            {
                $this->_orderCurrency = $orderCurrency;
            }

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCurrency()
        {
            return $this->_orderCurrency;
        }

        // ##########################################

        /**
         * @param $orderCustomerAddressAdditional
         * @return $this
         */
        public function setOrderCustomerAddressAdditional($orderCustomerAddressAdditional)
        {
            $this->_orderCustomerAddressAdditional = $orderCustomerAddressAdditional;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerAddressAdditional()
        {
            return $this->_orderCustomerAddressAdditional;
        }

        // ##########################################

        /**
         * @param $orderCustomerAddressCity
         * @return $this
         */
        public function setOrderCustomerAddressCity($orderCustomerAddressCity)
        {
            $this->_orderCustomerAddressCity = $orderCustomerAddressCity;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerAddressCity()
        {
            return $this->_orderCustomerAddressCity;
        }

        // ##########################################

        /**
         * @param $orderCustomerAddressCountry
         * @return $this
         */
        public function setOrderCustomerAddressCountry($orderCustomerAddressCountry)
        {
            $orderCustomerAddressCountry = strtoupper($orderCustomerAddressCountry);

            if(in_array($orderCustomerAddressCountry, $this->_getCountriesAvailable()))
            {
                $this->_orderCustomerAddressCountry = $orderCustomerAddressCountry;
            }

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerAddressCountry()
        {
            return $this->_orderCustomerAddressCountry;
        }

        // ##########################################

        /**
         * @param $orderCustomerAddressState
         * @return $this
         */
        public function setOrderCustomerAddressState($orderCustomerAddressState)
        {
            $this->_orderCustomerAddressState = $orderCustomerAddressState;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerAddressState()
        {
            return $this->_orderCustomerAddressState;
        }

        // ##########################################

        /**
         * @param $orderCustomerAddressStreet
         * @return $this
         */
        public function setOrderCustomerAddressStreet($orderCustomerAddressStreet)
        {
            $this->_orderCustomerAddressStreet = $orderCustomerAddressStreet;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerAddressStreet()
        {
            return $this->_orderCustomerAddressStreet;
        }

        // ##########################################

        /**
         * @param $orderCustomerAddressZip
         * @return $this
         */
        public function setOrderCustomerAddressZip($orderCustomerAddressZip)
        {
            $this->_orderCustomerAddressZip = $orderCustomerAddressZip;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerAddressZip()
        {
            return $this->_orderCustomerAddressZip;
        }

        // ##########################################

        /**
         * @param $orderCustomerBirthdate
         * @return $this
         */
        public function setOrderCustomerBirthdate($orderCustomerBirthdate)
        {
            $this->_orderCustomerBirthdate = $orderCustomerBirthdate;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerBirthdate()
        {
            return $this->_orderCustomerBirthdate;
        }

        // ##########################################

        /**
         * @param $orderCustomerEmail
         * @return $this
         */
        public function setOrderCustomerEmail($orderCustomerEmail)
        {
            $this->_orderCustomerEmail = $orderCustomerEmail;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerEmail()
        {
            return $this->_orderCustomerEmail;
        }

        // ##########################################

        /**
         * @param $orderCustomerFirstName
         * @return $this
         */
        public function setOrderCustomerFirstName($orderCustomerFirstName)
        {
            $this->_orderCustomerFirstName = $orderCustomerFirstName;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerFirstName()
        {
            return $this->_orderCustomerFirstName;
        }

        // ##########################################

        /**
         * @param $orderCustomerLastName
         * @return $this
         */
        public function setOrderCustomerLastName($orderCustomerLastName)
        {
            $this->_orderCustomerLastName = $orderCustomerLastName;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerLastName()
        {
            return $this->_orderCustomerLastName;
        }

        // ##########################################

        /**
         * @param $orderCustomerPhone
         * @return $this
         */
        public function setOrderCustomerPhone($orderCustomerPhone)
        {
            $this->_orderCustomerPhone = $orderCustomerPhone;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerPhone()
        {
            return $this->_orderCustomerPhone;
        }

        // ##########################################

        /**
         * @param $orderCustomerTitle
         * @return $this
         */
        public function setOrderCustomerTitle($orderCustomerTitle)
        {
            $this->_orderCustomerTitle = $orderCustomerTitle;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderCustomerTitle()
        {
            return $this->_orderCustomerTitle;
        }

        // ##########################################

        /**
         * @param $label
         * @param $value
         * @return $this
         */
        public function addOrderProductDescriptions($label, $value)
        {
            if(count($this->_orderProductDescriptions) <= 5)
            {
                $this->_orderProductDescriptions[] = [
                    'label' => $label,
                    'value' => $value,
                ];
            }

            return $this;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getOrderProductDescriptions()
        {
            return $this->_orderProductDescriptions;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getOrderProductDescriptionsPrepared()
        {
            $_prepared = [];

            if(count($this->_orderProductDescriptions) > 0)
            {
                foreach($this->_orderProductDescriptions as $index => $descriptionArray)
                {
                    $count = $index + 1;
                    $_prepared['detail' . $count . '_description'] = $descriptionArray['label'];
                    $_prepared['detail' . $count . '_text'] = $descriptionArray['value'];
                }
            }

            return $_prepared;
        }

        // ##########################################

        /**
         * @param $orderTransactionId
         * @return $this
         */
        public function setOrderTransactionId($orderTransactionId)
        {
            $this->_orderTransactionId = $orderTransactionId;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderTransactionId()
        {
            return $this->_orderTransactionId;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getLanguagesAvailable()
        {
            return $this->_languagesAvailable;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getCurrenciesAvailable()
        {
            return $this->_currencyAvailable;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getCountriesAvailable()
        {
            return $this->_countriesAvailable;
        }

        // ##########################################

        /**
         * @param $orderLanguage
         * @return $this
         */
        public function setOrderLanguage($orderLanguage)
        {
            $orderLanguage = strtolower($orderLanguage);

            if(in_array($orderLanguage, $this->_getLanguagesAvailable()))
            {
                $this->_orderLanguage = $orderLanguage;
            }

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getOrderLanguage()
        {
            return $this->_orderLanguage;
        }

        // ##########################################

        /**
         * @return string
         */
        protected function _getOrderLanguageDefault()
        {
            return $this->_orderLanguageDefault;
        }

        // ##########################################

        /**
         * @param $redirectSofortUeberweisung
         * @return $this
         */
        public function setRedirectSofortUeberweisung($redirectSofortUeberweisung)
        {
            $this->_redirectSofortUeberweisung = $redirectSofortUeberweisung !== FALSE ? 1 : 0;

            return $this;
        }

        // ##########################################

        /**
         * @return int
         */
        protected function _getRedirectSofortUeberweisung()
        {
            return $this->_redirectSofortUeberweisung;
        }

        // ##########################################

        /**
         * @param $callback
         * @return $this
         */
        public function setUrlOrEmailCallback($callback)
        {
            $this->_urlOrEmailCallback = $callback;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getUrlOrEmailCallback()
        {
            return $this->_urlOrEmailCallback;
        }

        // ##########################################

        /**
         * @param $callback
         * @return $this
         */
        public function setUrlOrEmailCallbackAlternative($callback)
        {
            $this->_urlOrEmailCallbackAlternative = $callback;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getUrlOrEmailCallbackAlternative()
        {
            return $this->_urlOrEmailCallbackAlternative;
        }

        // ##########################################

        /**
         * @param $urlCancel
         * @return $this
         */
        public function setUrlCancel($urlCancel)
        {
            $this->_urlCancel = $urlCancel;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getUrlCancel()
        {
            return $this->_urlCancel;
        }

        // ##########################################

        /**
         * @param $urlCancelTarget
         * @return $this
         */
        public function setUrlCancelTarget($urlCancelTarget)
        {
            $this->_urlCancelTarget = $urlCancelTarget;

            return $this;
        }

        // ##########################################

        /**
         * @return int
         */
        protected function _getUrlCancelTarget()
        {
            return $this->_urlCancelTarget;
        }

        // ##########################################

        /**
         * @param $urlLogo
         * @return $this
         */
        public function setUrlLogo($urlLogo)
        {
            $this->_urlLogo = $urlLogo;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getUrlLogo()
        {
            return $this->_urlLogo;
        }

        // ##########################################

        /**
         * @param $urlReturn
         * @return $this
         */
        public function setUrlReturn($urlReturn)
        {
            $this->_urlReturn = $urlReturn;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getUrlReturn()
        {
            return $this->_urlReturn;
        }

        // ##########################################

        /**
         * @param $urlReturnButtonText
         * @return $this
         */
        public function setUrlReturnButtonText($urlReturnButtonText)
        {
            $this->_urlReturnButtonText = $urlReturnButtonText;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        protected function _getUrlReturnButtonText()
        {
            return $this->_urlReturnButtonText;
        }

        // ##########################################

        /**
         * @param $urlReturnTarget
         * @return $this
         */
        public function setUrlReturnTarget($urlReturnTarget)
        {
            $this->_urlReturnTarget = $urlReturnTarget;

            return $this;
        }

        // ##########################################

        /**
         * @return int
         */
        protected function _getUrlReturnTarget()
        {
            return $this->_urlReturnTarget;
        }

        // ##########################################

        /**
         * @param $paymentMethodsString
         * @return $this
         */
        public function setOrderEnabledPaymentMethods($paymentMethodsString)
        {
            $this->_orderEnabledPaymentMethodsString = $paymentMethodsString;

            return $this;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _getOrderEnabledPaymentMethods()
        {
            return $this->_orderEnabledPaymentMethodsString;
        }

        // ##########################################

        /**
         * @return array
         */
        protected function _builtCheckoutUrlParameters()
        {
            // set base data
            $data = [
                'prepare_only'          => $this->_isPreparedOrder(),
                'payment_methods'       => $this->_getOrderEnabledPaymentMethods(),
                'pay_to_email'          => $this->_getMerchantAccountEmail(),
                'recipient_description' => $this->_getMerchantName(),
                'transaction_id'        => $this->_getOrderTransactionId(),
                'return_url'            => $this->_getUrlReturn(),
                'return_url_text'       => $this->_getUrlReturnButtonText(),
                'return_url_target'     => $this->_getUrlReturnTarget(),
                'cancel_url'            => $this->_getUrlCancel(),
                'cancel_url_target'     => $this->_getUrlCancelTarget(),
                'status_url'            => $this->_getUrlOrEmailCallback(),
                'status_url2'           => $this->_getUrlOrEmailCallbackAlternative(),
                'new_window_redirect'   => $this->_getRedirectSofortUeberweisung(),
                'language'              => $this->_getOrderLanguage(),
                'hide_login'            => $this->_isHideLoginSection(),
                'confirmation_note'     => $this->_getOrderConfirmationNote(),
                'logo_url'              => $this->_getUrlLogo(),
                'rid'                   => $this->_getOrderAffiliateId(),
                'ext_ref_id'            => $this->_getOrderAffiliateName(),
                'pay_from_email'        => $this->_getOrderCustomerEmail(),
                'title'                 => $this->_getOrderCustomerTitle(),
                'firstname'             => $this->_getOrderCustomerFirstName(),
                'lastname'              => $this->_getOrderCustomerLastName(),
                'date_of_birth'         => $this->_getOrderCustomerBirthdate(),
                'address'               => $this->_getOrderCustomerAddressStreet(),
                'address2'              => $this->_getOrderCustomerAddressAdditional(),
                'phone_number'          => $this->_getOrderCustomerPhone(),
                'postal_code'           => $this->_getOrderCustomerAddressZip(),
                'city'                  => $this->_getOrderCustomerAddressCity(),
                'state'                 => $this->_getOrderCustomerAddressState(),
                'country'               => $this->_getOrderCustomerAddressCountry(),
                'amount'                => $this->_getOrderAmount(),
                'currency'              => $this->_getOrderCurrency(),
                'merchant_fields'       => $this->_getOrderMerchantFields(),
            ];

            // include cost descriptions
            $data = array_merge($data, $this->_getOrderCostDescriptionsPrepared());

            // include product descriptions
            $data = array_merge($data, $this->_getOrderProductDescriptions());

            // include callback data
            $data = array_merge($data, $this->_getOrderCallbackData());

            // return complete data
            return $data;
        }

        // ##########################################

        /**
         * @return $this
         * @throws \Exception
         */
        public function requestCheckoutToken()
        {
            $gatewayUrl = $this->_getUrlGatewayActive();
            $orderData = $this->_builtCheckoutUrlParameters();
            $orderDataQueryString = http_build_query($orderData);

            // request session sid (token)
            $checkoutToken = $this
                ->_getCurlClass()
                ->init($gatewayUrl)
                ->setPost(TRUE)
                ->setPostFields($orderDataQueryString)
                ->setReturnTransfer(TRUE)
                ->execute();

            // in case we cannot find any token
            if(empty($checkoutToken))
            {
                throw new \Exception('Failed to receive checkout token.', 500);
            }

            // cache token for runtime
            $this->setCheckoutToken($checkoutToken);

            return $this;
        }

        // ##########################################

        /**
         * @param $html
         * @return bool
         */
        protected function _parseCheckoutToken($html)
        {
            preg_match('/sid=([^\W]+)/', $html, $match);

            if(isset($match[1]))
            {
                return $match[1];
            }

            return FALSE;
        }

        // ##########################################

        /**
         * @param $token
         * @return $this
         */
        public function setCheckoutToken($token)
        {
            $this->_orderCheckoutToken = $token;

            return $this;
        }

        // ##########################################

        /**
         * @return mixed
         */
        public function getCheckoutToken()
        {
            return $this->_orderCheckoutToken;
        }

        // ##########################################

        /**
         * @return string
         */
        public function getCheckoutUrl()
        {
            // get active gatway url (sandbox on/off)
            $gatewayUrl = $this->_getUrlGatewayActive();

            // checkout token
            $checkoutToken = $this->getCheckoutToken();

            // return combined url
            return $gatewayUrl . '?sid=' . $checkoutToken;
        }
    }
