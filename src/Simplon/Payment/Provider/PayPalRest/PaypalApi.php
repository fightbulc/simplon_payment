<?php

    namespace Simplon\Payment\Provider\PaypalRest;

    use Simplon\Payment\PaymentHelper;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeExecuteVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargePayerVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeValidationVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\PaypalAuthVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\PaypalChargeVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\PaypalSaleVo;

    class PaypalApi
    {
        /** @var  PaypalAuthVo */
        protected $_authVo;

        // ######################################

        /**
         * @param PaypalAuthVo $authVo
         */
        public function __construct(PaypalAuthVo $authVo)
        {
            $this->_authVo = $authVo;

            PaypalApiRequests::setClientId($authVo->getClientId());
            PaypalApiRequests::setSecret($authVo->getSecret());
            PaypalApiRequests::setSandbox($authVo->getSandbox());
        }

        // ######################################

        /**
         * @return PaypalAuthVo
         */
        protected function _getAuthVo()
        {
            return $this->_authVo;
        }

        // ######################################

        /**
         * @return bool
         */
        protected function _isSandbox()
        {
            return $this->_getAuthVo()
                ->getSandbox();
        }

        // ######################################

        /**
         * @param $cents
         *
         * @return string
         */
        public function convertCentsToPaypalAmount($cents)
        {
            return number_format($cents / 100, 2);
        }

        // ######################################

        /**
         * @param ChargePayerVo $chargePayerVoCustomData
         *
         * @return array
         */
        protected function _createChargePayerData(ChargePayerVo $chargePayerVoCustomData)
        {
            $payerData = [
                'payment_method' => $chargePayerVoCustomData->getPayMethod(),
            ];

            if ($chargePayerVoCustomData->getPayMethod() === 'credit_card')
            {
                // handle credit card data
            }

            return $payerData;
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return array
         */
        protected function _createChargeTransactionsData(ChargeVo $chargeVo)
        {
            $transactions = [];
            $itemsList = [];

            // ----------------------------------

            $currency = $chargeVo->getCurrency();

            if ($this->_isSandbox())
            {
                $currency = 'USD';
            }

            // ----------------------------------

            $chargeProductVoMany = $chargeVo->getChargeProductVoMany();

            foreach ($chargeProductVoMany as $chargeProductVo)
            {
                $itemsList[] = [
                    'quantity' => 1,
                    'name'     => $chargeProductVo->getName(),
                    'price'    => $this->convertCentsToPaypalAmount($chargeProductVo->getSubTotalAmountCents()),
                    'currency' => $currency,
                    'sku'      => $chargeProductVo->getReferenceId(),
                ];
            }

            $transactions[] = [
                'amount'      => [
                    'total'    => $this->convertCentsToPaypalAmount($chargeVo->getTotalAmountCents()),
                    'currency' => $currency,
                    'details'  => [
                        'subtotal' => $this->convertCentsToPaypalAmount($chargeVo->getSubTotalAmountCents()),
                        'tax'      => $this->convertCentsToPaypalAmount($chargeVo->getTotalVatAmountCents()),
                    ]
                ],
                'description' => $chargeVo->getDescription(),
                'item_list'   => [
                    'items' => $itemsList,
                ],
            ];

            return $transactions;
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return PaypalChargeVo
         */
        public function authoriseCharge(ChargeVo $chargeVo)
        {
            /** @var ChargePayerVo $chargePayerVo */
            $chargePayerVo = $chargeVo->getChargePayerVo();

            $data = [
                'intent'        => 'sale',
                'redirect_urls' => [
                    'return_url' => $chargeVo->getUrlSuccess(),
                    'cancel_url' => $chargeVo->getUrlCancel(),
                ],
                'payer'         => $this->_createChargePayerData($chargePayerVo),
                'transactions'  => $this->_createChargeTransactionsData($chargeVo),
            ];

            $response = PaypalApiRequests::create(PaypalApiConstants::PATH_PAYMENTS_CREATE, $data);

            return (new PaypalChargeVo())->setData($response);
        }

        // ######################################

        /**
         * @param ChargeExecuteVo $chargeExecuteVo
         *
         * @return PaypalChargeVo
         */
        public function executeCharge(ChargeExecuteVo $chargeExecuteVo)
        {
            $response = PaypalApiRequests::update(
                PaypalApiConstants::PATH_PAYMENTS_EXECUTE,
                [
                    'paymentId' => $chargeExecuteVo->getPaymentId(),
                ],
                [
                    'payer_id' => $chargeExecuteVo->getPayerId(),
                ]
            );

            return (new PaypalChargeVo())->setData($response);
        }

        // ######################################

        /**
         * @param $paymentId
         *
         * @return PaypalChargeVo
         */
        public function getCharge($paymentId)
        {
            $response = PaypalApiRequests::retrieve(
                PaypalApiConstants::PATH_PAYMENTS_RETRIEVE,
                [
                    'paymentId' => $paymentId,
                ]
            );

            return (new PaypalChargeVo())->setData($response);
        }

        // ######################################

        /**
         * @param $saleId
         *
         * @return PaypalChargeVo
         */
        public function getSale($saleId)
        {
            $response = PaypalApiRequests::retrieve(
                PaypalApiConstants::PATH_SALES_RETRIEVE,
                [
                    'saleId' => $saleId,
                ]
            );

            return (new PaypalSaleVo())->setData($response);
        }

        // ######################################

        /**
         * @param ChargeValidationVo $chargeValidationVo
         * @param PaypalChargeVo $paypalChargeVo
         *
         * @return bool
         */
        public function isValidCharge(ChargeValidationVo $chargeValidationVo, PaypalChargeVo $paypalChargeVo)
        {
            $expectedAuthState = 'APPROVED';

            $validState = PaymentHelper::isStringEqual(
                $expectedAuthState,
                $paypalChargeVo->getState()
            );

            if ($validState === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "State doesnt match the expected",
                    $expectedAuthState,
                    $paypalChargeVo->getState()
                );
            }

            // ------------------------------

            $paypalChargeTransactionVoMany = $paypalChargeVo->getPaypalChargeTransactionVoMany();

            if ($paypalChargeTransactionVoMany === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Missing paypal's transaction object"
                );
            }

            // sandbox only accepts USD
            $expectedCurrency = $this->_isSandbox() === TRUE ? 'USD' : $chargeValidationVo->getCurrency();
            $receivedCurrency = $paypalChargeTransactionVoMany[0]->getCurrency();

            $validCurrency = PaymentHelper::isStringEqual($receivedCurrency, $expectedCurrency);

            if ($validCurrency === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Currencies don't match up",
                    $expectedCurrency,
                    $receivedCurrency
                );
            }

            // ------------------------------

            $validAmount = PaymentHelper::isIntegerEqual(
                $chargeValidationVo->getTotalAmountCents(),
                $paypalChargeTransactionVoMany[0]->getTotalCents()
            );

            if ($validAmount === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Charge amounts don't match up",
                    $chargeValidationVo->getTotalAmountCents(),
                    $paypalChargeTransactionVoMany[0]->getTotalCents()
                );
            }

            // ------------------------------

            $paypalSaleVo = $paypalChargeTransactionVoMany[0]->getPaypalSaleVo();

            if ($paypalSaleVo === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Missing paypal's sale object"
                );
            }

            $expectedSaleState = 'COMPLETED';
            $isStateCompleted = PaymentHelper::isStringEqual($expectedAuthState, $paypalSaleVo->getState());

            if ($isStateCompleted === FALSE)
            {
                return PaymentHelper::createErrorMessage(
                    "Sale state doesn't match up",
                    $expectedSaleState,
                    $paypalSaleVo->getState()
                );
            }

            // ------------------------------

            return TRUE;
        }
    }