<?php

    namespace Test\PaypalRest;

    use Codeception\TestCase\Test;
    use Simplon\Payment\Provider\PaypalRest\Paypal;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargeCustomDataVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\ChargePayerCustomDataVo;
    use Simplon\Payment\Provider\PaypalRest\Vo\PaypalAuthVo;
    use Simplon\Payment\Vo\ChargePayerVo;
    use Simplon\Payment\Vo\ChargeProductVo;
    use Simplon\Payment\Vo\ChargeVo;

    class PaypalTest extends Test
    {
        /**
         * @var \Test\CodeGuy
         */
        protected $codeGuy;
        protected $_config;

        // ######################################

        protected function _before()
        {
            require __DIR__ . '/../../_data/config.php';
            $this->_config = $config;
        }

        // ######################################

        protected function _after()
        {
        }

        // ######################################

        /**
         * @return \Test\CodeGuy
         */
        public function getCodeGuy()
        {
            return $this->codeGuy;
        }

        // ######################################

        /**
         * @return Paypal
         */
        public function getInstance()
        {
            $paypalAuthVo = (new PaypalAuthVo())
                ->setClientId($this->_config['paypal']['rest']['test']['clientId'])
                ->setSecret($this->_config['paypal']['rest']['test']['secret'])
                ->setSandbox(TRUE);

            return new Paypal($paypalAuthVo);
        }

        // ######################################

        /**
         * @param $classObject
         * @param $methodName
         * @param array $args
         *
         * @return mixed
         */
        public function invokeNonPublicMethod($classObject, $methodName, array $args)
        {
            $reflection = new \ReflectionClass($classObject);
            $method = $reflection->getMethod($methodName);
            $method->setAccessible(TRUE);

            return $method->invokeArgs($classObject, $args);
        }

        // ######################################

        /**
         * @return ChargeVo
         */
        protected function _getChargeVo()
        {
            $chargeProductVoMany = [];

            $chargeProductVoMany[] = (new ChargeProductVo())
                ->setName('Product#1')
                ->setReferenceId('123456789')
                ->setPriceCents(100)
                ->setPriceVat(19)
                ->setPriceIncludesVat(TRUE)
                ->setSurchargeCents(50)
                ->setSurchargeVat(19)
                ->setSurchargeIncludesVat(TRUE);

            $chargeCustomDataVo = (new ChargeCustomDataVo())
                ->setUrlSuccess('http://beatguide.me/s/')
                ->setUrlCancel('http://beatguide.me/c/');

            $payerCustomDataVo = (new ChargePayerCustomDataVo())
                ->setPayMethod('paypal');

            $chargePayerVo = (new ChargePayerVo())
                ->setCustomDataVo($payerCustomDataVo);

            return (new ChargeVo())
                ->setDescription('Here goes a description')
                ->setCurrency('EUR')
                ->setChargeProductVoMany($chargeProductVoMany)
                ->setChargePayerVo($chargePayerVo)
                ->setCustomDataVo($chargeCustomDataVo);
        }

        // ######################################

        public function testCreateTransactionData()
        {
            $response = $this->invokeNonPublicMethod(
                $this->getInstance(),
                '_createChargeTransactionsData',
                [$this->_getChargeVo()]
            );

            $this->assertInternalType('array', $response);
            $this->assertArrayHasKey(0, $response);

            $this->assertArrayHasKey('amount', $response[0]);
            $this->assertArrayHasKey('total', $response[0]['amount']);
            $this->assertInternalType('string', $response[0]['amount']['total']);
            $this->assertEquals('1.50', $response[0]['amount']['total']);

            $this->assertArrayHasKey('currency', $response[0]['amount']);
            $this->assertEquals('USD', $response[0]['amount']['currency']);

            $this->assertArrayHasKey('details', $response[0]['amount']);
            $this->assertArrayHasKey('subtotal', $response[0]['amount']['details']);
            $this->assertInternalType('string', $response[0]['amount']['details']['subtotal']);
            $this->assertEquals('1.26', $response[0]['amount']['details']['subtotal']);
            $this->assertInternalType('string', $response[0]['amount']['details']['tax']);
            $this->assertEquals('0.24', $response[0]['amount']['details']['tax']);

            $this->assertArrayHasKey('description', $response[0]);

            $this->assertArrayHasKey('item_list', $response[0]);
            $this->assertInternalType('string', $response[0]['item_list']['items'][0]['price']);
            $this->assertEquals('1.26', $response[0]['item_list']['items'][0]['price']);
            $this->assertEquals('USD', $response[0]['item_list']['items'][0]['currency']);
        }

        // ######################################

        public function testCreateChargePayerData()
        {
            $payerCustomDataVo = $this->_getChargeVo()
                ->getChargePayerVo()
                ->getCustomDataVo();

            $response = $this->invokeNonPublicMethod(
                $this->getInstance(),
                '_createChargePayerData',
                [$payerCustomDataVo]
            );

            $this->assertInternalType('array', $response);
            $this->assertArrayHasKey('payment_method', $response);
            $this->assertEquals('paypal', $response['payment_method']);
        }

        // ######################################

        public function testCreateCharge()
        {
            $paypalChargeVo = $this->getInstance()
                ->createCharge($this->_getChargeVo());

            $this->assertInstanceOf('Simplon\Payment\Provider\PaypalRest\Vo\PaypalChargeVo', $paypalChargeVo);
        }
    }