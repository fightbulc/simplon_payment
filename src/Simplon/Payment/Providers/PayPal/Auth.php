<?php

  namespace Simplon\Payment\Providers\PayPal;

  class Auth
  {
    /** @var String */
    protected $_username;

    /** @var String */
    protected $_password;

    /** @var String */
    protected $_signature;

    /** @var bool */
    protected $_sandboxMode = FALSE;

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
      $this->_password = $apiPassword;

      return $this;
    }

    // ##########################################

    /**
     * @return String
     */
    public function getPassword()
    {
      return $this->_password;
    }

    // ##########################################

    /**
     * @param $apiSignature
     * @return Auth
     */
    public function setSignature($apiSignature)
    {
      $this->_signature = $apiSignature;

      return $this;
    }

    // ##########################################

    /**
     * @return String
     */
    public function getSignature()
    {
      return $this->_signature;
    }

    // ##########################################

    /**
     * @param $apiUsername
     * @return Auth
     */
    public function setUsername($apiUsername)
    {
      $this->_username = $apiUsername;

      return $this;
    }

    // ##########################################

    /**
     * @return String
     */
    public function getUsername()
    {
      return $this->_username;
    }

    // ##########################################

    /**
     * @param bool $bool
     * @return Auth
     */
    public function setSandboxMode($bool = FALSE)
    {
      $this->_sandboxMode = $bool !== FALSE ? TRUE : FALSE;

      return $this;
    }

    // ##########################################

    /**
     * @return bool
     */
    public function isSandboxMode()
    {
      return $this->_sandboxMode;
    }
  }
