<?php

  namespace Simplon\Payment\PayPal\Vo;

  class AbstractVo
  {
    /** @var array */
    protected $_data = array();

    // ##########################################

    /**
     * @param $dataString
     * @return static
     */
    public static function init($dataString = '')
    {
      $class = new static();

      if(! empty($dataString))
      {
        $class->setData($dataString);
      }

      return $class;
    }

    // ##########################################

    /**
     * @param $string
     * @return array
     */
    protected function _parseResponseString($string)
    {
      $fields = array();
      $parts = explode('&', $string);

      foreach($parts as $part)
      {
        list($key, $val) = explode('=', $part);
        $key = strtolower($key);
        $fields[$key] = urldecode($val);
      }

      return $fields;
    }

    // ##########################################

    /**
     * @param $dataString
     * @return AbstractVo
     */
    public function setData($dataString)
    {
      $this->_data = $this->_parseResponseString($dataString);

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    protected function _getData()
    {
      return $this->_data;
    }

    // ##########################################

    /**
     * @param $key
     * @return bool|mixed
     */
    protected function _getByKey($key)
    {
      $key = strtolower($key);

      if(! isset($this->_data[$key]))
      {
        return FALSE;
      }

      return $this->_data[$key];
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getCorrelationId()
    {
      return $this->_getByKey('correlationid');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getAck()
    {
      return $this->_getByKey('ack');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getVersion()
    {
      return $this->_getByKey('version');
    }

    // ##########################################

    /**
     * @return bool|mixed
     */
    public function getBuild()
    {
      return $this->_getByKey('build');
    }

    // ##########################################

    /**
     * @return bool
     */
    public function isSuccess()
    {
      $ackValue = strtolower($this->_getByKey('ack'));

      return $ackValue == 'success';
    }

    // ##########################################

    /**
     * @return string
     */
    public function getErrors()
    {
      $errors = array();
      $data = $this->_getData();

      foreach($data as $k => $v)
      {
        if(strpos($k, 'errorcode') !== FALSE)
        {
          list($_, $index) = explode('errorcode', $k);

          if($_ == 'l_')
          {
            // cast index as int
            $index = (int)$index;

            // set error
            $errors[] = array(
              'code'         => $this->_getByKey('l_errorcode' . $index),
              'shortMessage' => $this->_getByKey('l_shortmessage' . $index),
              'longMessage'  => $this->_getByKey('l_longmessage' . $index),
            );
          }
        }
      }

      return json_encode($errors);
    }
  }
