<?php

    namespace Simplon\Payment\Provider\PaypalRest\Vo;

    class PaypalChargeLinksVo
    {
        protected $_links = [];

        // ######################################

        /**
         * @param array $data
         *
         * @return PaypalChargeLinksVo
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
        public function getUrlApproval()
        {
            return $this->_getUrlByRel('approval_url');
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getUrlExecute()
        {
            return $this->_getUrlByRel('execute');
        }

        // ######################################

        /**
         * @return bool|string
         */
        public function getUrlPayment()
        {
            return $this->_getUrlByRel('self');
        }
    }