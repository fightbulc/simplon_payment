<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    class PaypalSaleLinksVo
    {
        protected $_links = [];

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalSaleLinksVo
         */
        public function setData(array $data)
        {
            $this->_links = $data;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        public function getLinks()
        {
            return $this->_links;
        }

        // ######################################

        /**
         * @param $rel
         *
         * @return bool|string
         */
        protected function _getUrlByRel($rel)
        {
            $links = $this->getLinks();

            foreach ($links as $link)
            {
                if ((string)$link['rel'] === $rel)
                {
                    return (string)$link['href'];
                }
            }

            return FALSE;
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getUrlRefund()
        {
            return $this->_getUrlByRel('refund');
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getUrlParentPayment()
        {
            return $this->_getUrlByRel('parent_payment');
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getUrlSale()
        {
            return $this->_getUrlByRel('self');
        }
    }