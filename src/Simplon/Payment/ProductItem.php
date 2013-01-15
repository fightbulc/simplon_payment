<?php

  namespace Simplon\Payment;

  class ProductItem
  {
    /** @var string */
    protected $_refId;

    /** @var string */
    protected $_name;

    /** @var string */
    protected $_description;

    /** @var float */
    protected $_price = 0.00;

    /** @var int */
    protected $_tax;

    /** @var int */
    protected $_quantity = 0;

    // ##########################################

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
      $this->_description = $description;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    public function getDescription()
    {
      return $this->_description;
    }

    // ##########################################

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
      $this->_name = $name;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    public function getName()
    {
      return $this->_name;
    }

    // ##########################################

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price)
    {
      $this->_price = $price;

      return $this;
    }

    // ##########################################

    /**
     * @return float
     */
    public function getPrice()
    {
      return round($this->_price, 2);
    }

    // ##########################################

    /**
     * @param $tax
     * @return $this
     */
    public function setTax($tax)
    {
      $this->_tax = $tax;

      return $this;
    }

    // ##########################################

    /**
     * @return int
     */
    public function getTax()
    {
      return $this->_tax;
    }

    // ##########################################

    /**
     * @param $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
      $this->_quantity = $quantity;

      return $this;
    }

    // ##########################################

    /**
     * @return int
     */
    public function getQuantity()
    {
      return $this->_quantity;
    }

    // ##########################################

    /**
     * @param $refId
     * @return $this
     */
    public function setRefId($refId)
    {
      $this->_refId = $refId;

      return $this;
    }

    // ##########################################

    /**
     * @return string
     */
    public function getRefId()
    {
      return $this->_refId;
    }
  }
