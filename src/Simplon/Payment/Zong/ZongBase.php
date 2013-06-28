<?php

    namespace Simplon\Payment\Zong;

    use Simplon\Payment\Zong\Vo\PriceLookupVo;

    class ZongBase
    {
        protected $_priceLookupUri = 'https://pay01.zong.com/zongpay/actions/default?method=lookup';
        protected $_customerKey = 'zong-plus';

        #########################################

        protected function _getXmlPriceLookupUri(PriceLookupVo $priceLookupVo)
        {
            $xml = new \DOMDocument();
            $xml->encoding = 'utf-8';
            $xml->xmlVersion = '1.0';

            $requestMobilePaymentProcessEntrypoints = $xml->createElement('requestMobilePaymentProcessEntrypoints');
            $xmlns = new \DOMAttr('xmlns', 'http://pay01.zong.com/zongpay');
            $requestMobilePaymentProcessEntrypoints->setAttributeNode($xmlns);
            $xmlns_xsi = new \DOMAttr('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
            $requestMobilePaymentProcessEntrypoints->setAttributeNode($xmlns_xsi);
            $xsi_schemeLocation = new \DOMAttr('xsi:schemaLocation', 'http://pay01.zong.com/zongpay/zongpay.xsd');
            $requestMobilePaymentProcessEntrypoints->setAttributeNode($xsi_schemeLocation);

            $customerKey = $xml->createElement('customerKey', $this->_customerKey);
            $requestMobilePaymentProcessEntrypoints->appendChild($customerKey);

            $countryCode = $xml->createElement('countryCode', $priceLookupVo->getCountryCode());
            $requestMobilePaymentProcessEntrypoints->appendChild($countryCode);

            $items = $xml->createElement('items');
            $currency = new \DOMAttr('currency', $priceLookupVo->getCurrecyCode());
            $items->setAttributeNode($currency);
            $requestMobilePaymentProcessEntrypoints->appendChild($items);

            $xml->appendChild($requestMobilePaymentProcessEntrypoints);

            return $xml->saveXML();
        }

        #########################################

        protected function  _requestPriceLookupResponse($xmlRequest)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->_priceLookupUri);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/xml; charset=utf-8"));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $xmlResponse = curl_exec($ch);

            curl_close($ch);

            return $xmlResponse;
        }

        #########################################

        protected function _getEntrypointUrl($xmlResponse)
        {
            $entrypointUrl = '';

            $xml = new \DOMDocument();
            $xml->load($xmlResponse);

            $items = $xml->getElementsByTagName("items");
            foreach ($items as $item)
            {
                $params = $item->getElementsByTagName("item");
                foreach ($params as $param)
                {
                    $entrypointUrls = $param->getElementsByTagName("entrypointUrl");
                    foreach ($entrypointUrls as $paramEntrypointUrl)
                    {
                        $entrypointUrl = $paramEntrypointUrl->nodeValue;
                        break;
                    }
                }
            }

            return $entrypointUrl;
        }

    }