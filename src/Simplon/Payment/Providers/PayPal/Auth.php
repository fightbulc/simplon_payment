<?php

  namespace Simplon\Payment\Providers\PayPal;

  class Auth
  {
    /** @var String */
    protected $_apiUsername;

    /** @var String */
    protected $_apiPassword;

    /** @var String */
    protected $_apiSignature;

    // ##########################################

    /**
     * @return Auth
     */
    public static function init()
    {
      return new Auth();
    }

    // ##########################################

    /**
     * @param $apiPassword
     * @return Auth
     */
    public function setPassword($apiPassword)
    {
      $this->_apiPassword = $apiPassword;

      return $this;
    }

    // ##########################################

    /**
     * @return String
     */
    public function getApiPassword()
    {
      return $this->_apiPassword;
    }

    // ##########################################

    /**
     * @param $apiSignature
     * @return Auth
     */
    public function setSignature($apiSignature)
    {
      $this->_apiSignature = $apiSignature;

      return $this;
    }

    // ##########################################

    /**
     * @return String
     */
    public function getApiSignature()
    {
      return $this->_apiSignature;
    }

    // ##########################################

    /**
     * @param $apiUsername
     * @return Auth
     */
    public function setUsername($apiUsername)
    {
      $this->_apiUsername = $apiUsername;

      return $this;
    }

    // ##########################################

    /**
     * @return String
     */
    public function getApiUsername()
    {
      return $this->_apiUsername;
    }
  }
