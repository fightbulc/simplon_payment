<?php

  namespace Simplon\Payment\Providers\PayPal\Vo;

  class TokenResponseVo extends AbstractVo
  {
    /**
     * @return bool|mixed
     */
    public function getTimestamp()
    {
      return $this->_getByKey('timestamp');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getToken()
    {
      return $this->_getByKey('token');
    }
  }
