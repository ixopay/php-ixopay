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

    /** @var  string */
    protected $unit;

    /** @var  float */
    protected $unitPrice;

    /** @var  float */
    protected $discount;

    /** @var  int */
    protected $shippingAmount;

    /** @var  float */
    protected $taxAmount;

    /** @var  float */
    protected $taxRate;

    /** @var  string */
    protected $commodityCode;

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
     * @return string
     */
    public function getUnit() {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return $this
     */
    public function setUnit($unit) {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice() {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     * @return $this
     */
    public function setUnitPrice($unitPrice) {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscount() {
        return $this->discount;
    }

    /**
     * @param float $discount
     * @return $this
     */
    public function setDiscount($discount) {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return int
     */
    public function getShippingAmount() {
        return $this->shippingAmount;
    }

    /**
     * @param int $shippingAmount
     * @return $this
     */
    public function setShippingAmount($shippingAmount) {
        $this->shippingAmount = $shippingAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxAmount() {
        return $this->taxAmount;
    }

    /**
     * @param float $taxAmount
     * @return $this
     */
    public function setTaxAmount($taxAmount) {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxRate() {
        return $this->taxRate;
    }

    /**
     * @param float $taxRate
     * @return $this
     */
    public function setTaxRate($taxRate) {
        $this->taxRate = $taxRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommodityCode() {
        return $this->commodityCode;
    }

    /**
     * @param string $commodityCode
     * @return $this
     */
    public function setCommodityCode($commodityCode) {
        $this->commodityCode = $commodityCode;
        return $this;
    }
}
