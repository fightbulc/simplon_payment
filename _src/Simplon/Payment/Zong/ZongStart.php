<?php

    namespace Simplon\Payment\Zong;

    use Simplon\Payment\Zong\Vo\PriceLookupVo;

    class ZongStart extends ZongBase
    {
        public function getEntrypointUrl(array $data)
        {
            $priceLookupVo = new PriceLookupVo($data);
            $xml = $this->_getXmlPriceLookupUri($priceLookupVo);
            $requestPriceLookup = $this->_requestPriceLookupResponse($xml);

            throw new \Exception(var_export($xml, TRUE), 500);

            return $this->_getEntrypointUrl($requestPriceLookup);
        }
    }