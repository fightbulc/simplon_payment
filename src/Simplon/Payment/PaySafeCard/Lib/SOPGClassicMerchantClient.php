<?php

    namespace Simplon\Payment\PaySafeCard\Lib;

    class SOPGClassicMerchantClient
    {
        private $client;

        public function __construct($endPoint)
        {
            try
            {
                $this->client = new \SoapClient($endPoint);
            }
            catch (Exception $e)
            {
                throw new Exception('Error creating SoapClient: ' . $e->getMessage());
            }
        }

        /**
         * Calls the CreateDisposition web service method.
         *
         * @param username
         *          Username to use for the web service call.
         * @param password
         *          Password to use for the web service call.
         * @param mtid
         *          Merchant transaction id to use for the web service call. It must
         *          be unique for each invocation.
         * @param subId
         *          SubId to use for the web service call. The parameter is optional
         *          and can be <code>null</code>.
         * @param amount
         *          Amount to use for the web service call.
         * @param currency
         *          Currency to use for the web service call. It must contain a 3
         *          letter ISO 4217 currency code.
         * @param okUrl
         *          OKUrl to use for the web service call.
         * @param nokUrl
         *          NOKurl to use for the web service call.
         * @param merchantClientId
         *          ID of the client to use for the web service call. This is
         *          merchant's internal id to identify the client. The parameter is
         *          optional and can be <code>null</code>.
         * @param pnUrl
         *          Payment notification URL to use for the web service call. The
         *          parameter is optional and can be <code>null</code>.
         * @param clientIp
         *          IP address of the client to use for the web service call. This is
         *          the IP of the client when connecting to the merchant. The
         *          parameter is optional and can be <code>null</code>.
         *
         * @return Response of the CreateDisposition web service call. The call was
         *         successful if resultCode and errorCode of the response are 0. For
         *         list of possible error codes refer to merchant documentation.
         * @throws InvalidArgumentException
         *           If required parameters are null or empty.
         */
        public function createDisposition($username, $password, $mtid, $subId, $amount, $currency, $okUrl, $nokUrl, $merchantClientId, $pnUrl, $clientIp)
        {
            Validators::validateStringNotNull($username, 'username');
            Validators::validateStringNotNull($password, 'password');
            Validators::validateStringNotNull($mtid, 'mtid');
            Validators::validateStringNotNull($okUrl, 'okUrl');
            Validators::validateStringNotNull($nokUrl, 'nokUrl');
            Validators::validateCurrency($currency);

            $params = array(
                'username'         => $username,
                'password'         => $password,
                'mtid'             => $mtid,
                'subId'            => $subId,
                'amount'           => $amount,
                'currency'         => strtoupper($currency),
                'okUrl'            => $okUrl,
                'nokUrl'           => $nokUrl,
                'merchantclientid' => $merchantClientId,
                'pnUrl'            => $pnUrl,
                'clientIp'         => $clientIp
            );
            $response = $this->client->createDisposition($params);

            return $response->createDispositionReturn;
        }

        /**
         * Calls the AssignCardToDisposition web service method.
         *
         * @param username
         *          Username to use for the web service call.
         * @param password
         *          Password to use for the web service call.
         * @param mtid
         *          Merchant transaction id to use for the web service call. It must
         *          be unique for each invocation.
         * @param subId
         *          SubId to use for the web service call. The parameter is optional
         *          and can be <code>null</code>.
         * @param amount
         *          Amount to use for the web service call.
         * @param currency
         *          Currency to use for the web service call. It must contain a 3
         *          letter ISO 4217 currency code.
         * @param pin
         *          PIN number to use for the web service call.
         *
         * @return Response of the AssignCardToDisposition web service call. The call
         *         was successful if resultCode and errorCode of the response are 0.
         *         For list of possible error codes refer to merchant documentation.
         * @throws InvalidArgumentException
         *           If required parameters are null or empty.
         */
        public function assignCardToDisposition($username, $password, $mtid, $subId, $amount, $currency, $pin)
        {
            Validators::validateStringNotNull($username, 'username');
            Validators::validateStringNotNull($password, 'password');
            Validators::validateStringNotNull($mtid, 'mtid');
            Validators::validateStringNotNull($pin, 'pin');
            Validators::validateCurrency($currency);

            $params = array(
                'username' => $username,
                'password' => $password,
                'mtid'     => $mtid,
                'subId'    => $subId,
                'amount'   => $amount,
                'currency' => strtoupper($currency),
                'pin'      => $pin
            );

            $response = $this->client->assignCardToDisposition($params);

            return $response->assignCardToDispositionReturn;
        }

        /** Calls the AssignCardsToDisposition web service method.
         *
         * @param username
         *          Username to use for the web service call.
         * @param password
         *          Password to use for the web service call.
         * @param mtid
         *          Merchant transaction id to use for the web service call. It must
         *          be unique for each invocation.
         * @param subId
         *          SubId to use for the web service call. The parameter is optional
         *          and can be <code>null</code>.
         * @param amount
         *          Amount to use for the web service call.
         * @param currency
         *          Currency to use for the web service call. It must contain a 3
         *          letter ISO 4217 currency code.
         * @param cards
         *          Card information (pin, password) to use for the web service call.
         *          At least one (1) card and at most ten (10) cards can be present in
         *          the request. Card passwords are optional and should be
         *          <code>null</code> if no password is specified for the given card.
         * @param locale
         *          Locale to use for the web service call. The parameter is optional
         *          and can be <code>null</code>.
         * @param acceptingTerms
         *          Integer value indicating if the user accepts Paysafecard's terms
         *          of use. Value should be 1 if user accepts terms of use.
         *
         * @return Response of the AssignCardToDisposition web service call. The call
         *         was successful if resultCode and errorCode of the response are 0.
         *         For list of possible error codes refer to merchant documentation.
         * @throws InvalidArgumentException
         *           If required parameters are null or empty.
         */
        public function assignCardsToDisposition($username, $password, $mtid, $subId, $amount, $currency, $locale, $acceptingTerms, $cards)
        {
            Validators::validateStringNotNull($username, 'username');
            Validators::validateStringNotNull($password, 'password');
            Validators::validateStringNotNull($mtid, 'mtid');
            Validators::validateCurrency($currency);
            Validators::validateCards($cards);

            $params = array(
                'username'       => $username,
                'password'       => $password,
                'mtid'           => $mtid,
                'subid'          => $subId,
                'amount'         => $amount,
                'currency'       => strtoupper($currency),
                'locale'         => $locale,
                'acceptingTerms' => $acceptingTerms,
                'cards'          => $cards
            );

            $response = $this->client->assignCardsToDisposition($params);

            return $response->assignCardsToDispositionReturn;
        }

        /**
         * Calls the ModifyDispositionValue web service method.
         *
         * @param username
         *          Username to use for the web service call.
         * @param password
         *          Password to use for the web service call.
         * @param mtid
         *          Merchant transaction id to use for the web service call. It must
         *          be unique for each invocation.
         * @param subId
         *          SubId to use for the web service call. The parameter is optional
         *          and can be <code>null</code>.
         * @param amount
         *          Amount to use for the web service call.
         * @param currency
         *          Currency to use for the web service call. It must contain a 3
         *          letter ISO 4217 currency code.
         *
         * @return Response of the ModifyDispositionValue web service call. The call
         *         was successful if resultCode and errorCode of the response are 0.
         *         For list of possible error codes refer to merchant documentation.
         * @throws InvalidArgumentException
         *           If required parameters are null or empty.
         */
        public function modifyDispositionValue($username, $password, $mtid, $subId, $amount, $currency)
        {
            Validators::validateStringNotNull($username, 'username');
            Validators::validateStringNotNull($password, 'password');
            Validators::validateStringNotNull($mtid, 'mtid');
            Validators::validateCurrency($currency);

            $params = array(
                'username' => $username,
                'password' => $password,
                'mtid'     => $mtid,
                'subid'    => $subId,
                'amount'   => $amount,
                'currency' => strtoupper($currency)
            );

            $response = $this->client->modifyDispositionValue($params);

            return $response->modifyDispositionValueReturn;
        }

        /**
         * Calls the GetSerialNumbers web service method.
         *
         * @param username
         *          Username to use for the web service call.
         * @param password
         *          Password to use for the web service call.
         * @param mtid
         *          Merchant transaction id to use for the web service call. It must
         *          be unique for each invocation.
         * @param subId
         *          SubId to use for the web service call. The parameter is optional
         *          and can be <code>null</code>.
         * @param currency
         *          Currency to use for the web service call. It must contain a 3
         *          letter ISO 4217 currency code.
         *
         * @return Response of the GetSerialNumbers web service call. The call was
         *         successful if resultCode and errorCode of the response are 0. For
         *         list of possible error codes refer to merchant documentation.
         * @throws InvalidArgumentException
         *           If required parameters are null or empty.
         */
        public function getSerialNumbers($username, $password, $mtid, $subId, $currency)
        {
            Validators::validateStringNotNull($username, 'username');
            Validators::validateStringNotNull($password, 'password');
            Validators::validateStringNotNull($mtid, 'mtid');
            Validators::validateCurrency($currency);

            $params = array(
                'username' => $username,
                'password' => $password,
                'mtid'     => $mtid,
                'subid'    => $subId,
                'currency' => strtoupper($currency)
            );

            $response = $this->client->getSerialNumbers($params);

            return $response->getSerialNumbersReturn;
        }

        /**
         * Calls GetDispositionRawState web service method.
         *
         * @param username
         *          Username to use for the web service call.
         * @param password
         *          Password to use for the web service call.
         * @param mtid
         *          Merchant transaction id to use for the web service call. It must
         *          be unique for each invocation.
         * @param subId
         *          SubId to use for the web service call. The parameter is optional
         *          and can be <code>null</code>.
         * @param currency
         *          Currency to use for the web service call. It must contain a 3
         *          letter ISO 4217 currency code.
         *
         * @return Response of the GetDispositionRawState web service call. The call
         *         was successful if resultCode and errorCode of the response are 0.
         *         For list of possible error codes refer to merchant documentation.
         * @throws InvalidArgumentException
         *           If required parameters are null or empty.
         */
        public function getDispositionRawState($username, $password, $mtid, $subId, $currency)
        {
            Validators::validateStringNotNull($username, 'username');
            Validators::validateStringNotNull($password, 'password');
            Validators::validateStringNotNull($mtid, 'mtid');
            Validators::validateCurrency($currency);

            $params = array(
                'username' => $username,
                'password' => $password,
                'mtid'     => $mtid,
                'subid'    => $subId,
                'currency' => strtoupper($currency)
            );

            $response = $this->client->getDispositionRawState($params);

            return $response->getDispositionRawStateReturn;
        }

        /**
         * Calls ExecuteDebit web service method.
         *
         * @param username
         *          Username to use for the web service call.
         * @param password
         *          Password to use for the web service call.
         * @param mtid
         *          Merchant transaction id to use for the web service call. It must
         *          be unique for each invocation.
         * @param subId
         *          SubId to use for the web service call. The parameter is optional
         *          and can be <code>null</code>.
         * @param amount
         *          Amount to use for the web service call.
         * @param currency
         *          Currency to use for the web service call. It must contain a 3
         *          letter ISO 4217 currency code.
         * @param close
         *          Close flag indicating if further debits will be executed or not.
         *          If the close flag is 1 the disposition will be set to totally
         *          consumed and no further debits are possible.
         * @param partialDebitId
         *          PartialDebitId to use for the web service call. The parameter is
         *          optional and can be <code>null</code>.
         * @ return Response of the ExecuteDebit web service call. The call was
         *          successful if resultCode and errorCode of the response are 0. For
         *          list of possible error codes refer to merchant documentation.
         *
         * @throws InvalidArgumentException
         *           If required parameters are null or empty.
         */
        public function executeDebit($username, $password, $mtid, $subId, $amount, $currency, $close, $partialDebitId)
        {
            Validators::validateStringNotNull($username, 'username');
            Validators::validateStringNotNull($password, 'password');
            Validators::validateStringNotNull($mtid, 'mtid');
            Validators::validateCurrency($currency);

            $params = array(
                'username'       => $username,
                'password'       => $password,
                'mtid'           => $mtid,
                'subid'          => $subId,
                'amount'         => $amount,
                'currency'       => strtoupper($currency),
                'close'          => $close,
                'partialDebitId' => $partialDebitId
            );

            $response = $this->client->executeDebit($params);

            return $response->executeDebitReturn;
        }

        /**
         * Calls the GetMid SOPG web service method.
         *
         * @param username
         *          Username to use for the web service call.
         * @param password
         *          Password to use for the web service call.
         * @param currency
         *          Currency to use for the web service call. It must contain a 3
         *          letter ISO 4217 currency code.
         *
         * @return Response containing mid configured for the given currency. The call
         *         was successful if resultCode and errorCode of the response are 0.
         *         For list of possible error codes refer to merchant documentation.
         * @throws InvalidArgumentException
         *           If required parameters are null or empty.
         */
        public function getMid($username, $password, $currency)
        {
            Validators::validateStringNotNull($username, 'username');
            Validators::validateStringNotNull($password, 'password');
            Validators::validateCurrency($currency);

            $params = array(
                'username' => $username,
                'password' => $password,
                'currency' => strtoupper($currency)
            );

            $response = $this->client->getMid($params);

            return $response->getMidReturn;
        }
    }
