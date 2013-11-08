<?php

    namespace Simplon\Payment\Provider\Paypal;

    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Iface\ProviderAuthInterface;
    use Simplon\Payment\Iface\ProviderInterface;
    use Simplon\Payment\Provider\Paypal\Vo\ChargePayerVoCustomData;
    use Simplon\Payment\Provider\Paypal\Vo\ChargeVoCustomData;
    use Simplon\Payment\Provider\Paypal\Vo\PaypalAuthVo;
    use Simplon\Payment\Provider\Paypal\Vo\PaypalChargeVo;
    use Simplon\Payment\Vo\ChargePayerVo;
    use Simplon\Payment\Vo\ChargeVo;

    class Paypal implements ProviderInterface
    {
        /**
         * @param ProviderAuthInterface $authVo
         */
        public function __construct(ProviderAuthInterface $authVo)
        {
            /** @var $authVo PaypalAuthVo */

            PaypalApiRequests::setClientId($authVo->getClientId());
            PaypalApiRequests::setSecret($authVo->getSecret());
            PaypalApiRequests::setSandbox($authVo->getSandbox());
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return ChargeVoCustomData
         */
        protected function _getChargeVoCustomData(ChargeVo $chargeVo)
        {
            /** @var ChargeVoCustomData $chargeVoCustomData */

            $chargeVoCustomData = $chargeVo->getCustomDataVo();

            return $chargeVoCustomData;
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return \Simplon\Payment\Vo\ChargePayerVo
         */
        protected function _getChargePayerVo(ChargeVo $chargeVo)
        {
            return $chargeVo->getChargePayerVo();
        }

        // ######################################

        /**
         * @param ChargePayerVo $chargePayerVo
         *
         * @return ChargePayerVoCustomData
         */
        protected function _getChargePayerVoCustomData(ChargePayerVo $chargePayerVo)
        {
            /** @var ChargePayerVoCustomData $chargePayerVoCustomData */

            $chargePayerVoCustomData = $chargePayerVo->getCustomDataVo();

            return $chargePayerVoCustomData;
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return \Simplon\Payment\Vo\ChargeProductVo[]
         */
        protected function _getChargeProductVoMany(ChargeVo $chargeVo)
        {
            return $chargeVo->getChargeProductVoMany();
        }

        // ######################################

        /**
         * @param ChargeVoInterface $chargeVo
         *
         * @return \Simplon\Payment\Iface\ChargeResponseVoInterface|void
         */
        public function processCharge(ChargeVoInterface $chargeVo)
        {
            $chargeVoCustomData = $this->_getChargeVoCustomData($chargeVo);

            // ----------------------------------

            // create payment
            if (!$chargeVoCustomData->getPaymentId())
            {
                $this->createCharge($chargeVo);
            }

            // ----------------------------------

            // execute payment
        }

        // ######################################

        /**
         * @param $cents
         *
         * @return int
         */
        protected function _convertCentsToPaypalAmount($cents)
        {
            return (int)round($cents / 100);
        }

        // ######################################

        /**
         * @param ChargePayerVoCustomData $chargePayerVoCustomData
         *
         * @return array
         */
        protected function _createChargePayerData(ChargePayerVoCustomData $chargePayerVoCustomData)
        {
            $payerData = [
                'payment_method' => $chargePayerVoCustomData->getMethod(),
            ];

            if ($chargePayerVoCustomData->getMethod() === 'credit_card')
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

            $chargeProductVoMany = $chargeVo->getChargeProductVoMany();

            foreach ($chargeProductVoMany as $chargeProductVo)
            {
                $itemsList[] = [
                    'quantity' => 1,
                    'name'     => $chargeProductVo->getName(),
                    'price'    => $this->_convertCentsToPaypalAmount($chargeProductVo->getTotalAmountCents()),
                    'currency' => $chargeVo->getCurrency(),
                    'sku'      => $chargeProductVo->getReferenceId(),
                ];
            }

            $transactions[] = [
                'amount'      => [
                    'total'    => $this->_convertCentsToPaypalAmount($chargeVo->getTotalAmountCents()),
                    'currency' => $chargeVo->getCurrency(),
                    'details'  => [
                        'subtotal' => $this->_convertCentsToPaypalAmount($chargeVo->getSubTotalAmountCents()),
                        'tax'      => $this->_convertCentsToPaypalAmount($chargeVo->getTotalVatAmountCents()),
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
         * @return bool|PaypalChargeVo
         */
        public function createCharge(ChargeVo $chargeVo)
        {
            /** @var ChargeVoCustomData $chargeCustomDataVo */
            $chargeCustomDataVo = $chargeVo->getCustomDataVo();

            /** @var ChargePayerVoCustomData $chargePayerVoCustomData */
            $chargePayerVoCustomData = $this->_getChargePayerVoCustomData($chargeVo->getChargePayerVo());

            // ----------------------------------

            $data = [
                'intent'        => 'sale',
                'redirect_urls' => [
                    'return_url' => $chargeCustomDataVo->getUrlSuccess(),
                    'cancel_url' => $chargeCustomDataVo->getUrlCancel(),
                ],
                'payer'         => $this->_createChargePayerData($chargePayerVoCustomData),
                'transactions'  => $this->_createChargeTransactionsData($chargeVo),
            ];

            $response = PaypalApiRequests::create(PaypalApiConstants::PATH_PAYMENTS_CREATE, $data);

            return (new PaypalChargeVo())->setData($response);
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return bool|PaypalChargeVo
         */
        public function executeCharge(ChargeVo $chargeVo)
        {
            /** @var ChargeVoCustomData $chargeCustomDataVo */
            $chargeCustomDataVo = $chargeVo->getCustomDataVo();

            /** @var ChargePayerVoCustomData $chargePayerVoCustomData */
            $chargePayerVoCustomData = $this->_getChargePayerVoCustomData($chargeVo->getChargePayerVo());

            // ----------------------------------

            $response = PaypalApiRequests::update(
                PaypalApiConstants::PATH_PAYMENTS_EXECUTE,
                [
                    'paymentId' => $chargeCustomDataVo->getPaymentId(),
                ],
                [
                    'payer_id' => $chargePayerVoCustomData->getPayerId(),
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
    }