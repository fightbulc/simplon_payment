<?php

    namespace Simplon\Payment\Provider\PaypalRest;

    use Simplon\Payment\ChargeStateConstants;
    use Simplon\Payment\Iface\ChargeVoInterface;
    use Simplon\Payment\Iface\ProviderAuthInterface;
    use Simplon\Payment\Iface\ProviderInterface;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeCustomDataVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargePayerVoCustomData;
    use Simplon\Payment\Provider\PaypalRest\Vo\PaypalAuthVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\PaypalChargeVo;
    use Simplon\Payment\Vo\ChargePayerVo;
    use Simplon\Payment\Vo\ChargeResponseVo;
    use Simplon\Payment\Vo\ChargeVo;

    class Paypal implements ProviderInterface
    {
        /** @var  PaypalAuthVo */
        protected $_authVo;

        // ######################################

        /**
         * @param ProviderAuthInterface $authVo
         */
        public function __construct(ProviderAuthInterface $authVo)
        {
            /** @var $authVo PaypalAuthVo */
            $this->_setAuthVo($authVo);

            PaypalApiRequests::setClientId($authVo->getClientId());
            PaypalApiRequests::setSecret($authVo->getSecret());
            PaypalApiRequests::setSandbox($authVo->getSandbox());
        }

        // ######################################

        /**
         * @param PaypalAuthVo $authVo
         *
         * @return Paypal
         */
        protected function _setAuthVo(PaypalAuthVo $authVo)
        {
            $this->_authVo = $authVo;

            return $this;
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
         * @return bool|\Simplon\Payment\Iface\ChargeResponseVoInterface|ChargeResponseVo
         */
        public function processCharge(ChargeVoInterface $chargeVo)
        {
            /** @var ChargeCustomDataVo $chargeVoCustomData */
            $chargeVoCustomData = $chargeVo->getCustomDataVo();

            // execute payment
            if ($chargeVoCustomData->getPaymentId())
            {
                return $this->_processExecuteCharge($chargeVo);
            }

            // ----------------------------------

            // create payment
            return $this->_processCreateCharge($chargeVo, $chargeVoCustomData);
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         * @param ChargeCustomDataVo $chargeVoCustomData
         *
         * @return ChargeResponseVo
         */
        protected function _processCreateCharge(ChargeVo $chargeVo, ChargeCustomDataVo $chargeVoCustomData)
        {
            $paypalChargeVo = $this->createCharge($chargeVo);

            // ----------------------------------

            $paypalChargeLinksVo = $paypalChargeVo->getPaypalChargeLinksVo();

            $chargeVoCustomData
                ->setUrlApproval($paypalChargeLinksVo->getUrlApproval())
                ->setPaymentId($paypalChargeVo->getId());

            return (new ChargeResponseVo())
                ->setReferenceId($chargeVo->getReferenceId())
                ->setDescription($chargeVo->getDescription())
                ->setCurrency($chargeVo->getCurrency())
                ->setChargePayerVo($chargeVo->getChargePayerVo())
                ->setChargeProductVoMany($chargeVo->getChargeProductVoMany())
                ->setStatus($this->_convertPaypalStateToSimplonState($paypalChargeVo->getState()))
                ->setCustomDataVo($chargeVoCustomData);
        }

        // ######################################

        /**
         * @param ChargeVo $chargeVo
         *
         * @return bool|ChargeResponseVo
         */
        protected function _processExecuteCharge(ChargeVo $chargeVo)
        {
            $paypalChargeVo = $this->executeCharge($chargeVo);

            // ----------------------------------

            // get transactions
            $paypalChargeTransactionVoMany = $paypalChargeVo->getPaypalChargeTransactionVoMany();
            $paypalChargeTransactionVo = $paypalChargeTransactionVoMany[0];

            // get paypalSaleVo
            $paypalSaleVo = $paypalChargeTransactionVo->getPaypalSaleVo();

            if ($paypalSaleVo !== FALSE)
            {
                return (new ChargeResponseVo())
                    ->setTransactionId($paypalSaleVo->getId())
                    ->setStatus($this->_convertPaypalStateToSimplonState($paypalSaleVo->getState()));
            }

            return FALSE;
        }

        // ######################################

        /**
         * @param $paypalState
         *
         * @return string
         */
        protected function _convertPaypalStateToSimplonState($paypalState)
        {
            switch ($paypalState)
            {
                case 'created':
                    $state = ChargeStateConstants::CREATED;
                    break;

                case 'approved':
                    $state = ChargeStateConstants::APPROVED;
                    break;

                case 'pending':
                    $state = ChargeStateConstants::PENDING;
                    break;

                case 'completed':
                    $state = ChargeStateConstants::COMPLETED;
                    break;

                case 'failed':
                    $state = ChargeStateConstants::FAILED;
                    break;

                case 'canceled':
                    $state = ChargeStateConstants::INVALID;
                    break;

                case 'expired':
                    $state = ChargeStateConstants::INVALID;
                    break;

                default:
                    $state = ChargeStateConstants::UNKNOWN;
            }

            return $state;
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
                    'price'    => $this->_convertCentsToPaypalAmount($chargeProductVo->getTotalAmountCents()),
                    'currency' => $currency,
                    'sku'      => $chargeProductVo->getReferenceId(),
                ];
            }

            $transactions[] = [
                'amount'      => [
                    'total'    => $this->_convertCentsToPaypalAmount($chargeVo->getTotalAmountCents()),
                    'currency' => $currency,
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
            /** @var ChargeCustomDataVo $chargeCustomDataVo */
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
            /** @var ChargeCustomDataVo $chargeCustomDataVo */
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