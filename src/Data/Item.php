<?php

namespace Ixopay\Client\Data;

/**
 * Class Item
 *
 * @package Ixopay\Client\Data
 */
class Item extends Data {

    /**
     * @var string
     */
    protected $identification;

    /** @var  string */
    protected $name;

    /** @var  float */
    protected $price;

    /** @var  string */
    protected $currency;

    /** @var  int */
    protected $quantity;

    /** @var  string */
    protected $description;

    /** @var array */
    protected $l2l3Data = array();

    /**
     * @return string
     */
    public function getIdentification() {
        return $this->identification;
    }

    /**
     * @param string $identification
	 * @return $this
     */
    public function setIdentification($identification) {
        $this->identification = $identification;
        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * @param array $l2l3Data
     *
     * @return $this
     */
    public function setL2L3Data($l2l3Data) {
        $this->l2l3Data = $l2l3Data;
        return $this;
    }

    /**
     * @return array
     */
    public function getL2L3Data() {
        return $this->l2l3Data;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function addL2L3Data($key, $value) {
        $this->l2l3Data[$key] = $value;
        return $this;
    }
}
