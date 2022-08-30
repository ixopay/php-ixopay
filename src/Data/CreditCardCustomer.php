<?php

namespace Ixopay\Client\Data;

/**
 * Specialized class to represent a customer with credit card data.
 *
 * @deprecated
 * @package Ixopay\Client\Data
 */
class CreditCardCustomer extends Customer {

    /**
     * @deprecated use $firstSix, $lastFour
     * @var string
     */
    protected $number;

    /**
     * @var int
     */
    protected $expiryMonth;
    /**
     * @var int
     */
    protected $expiryYear;
    /**
     * @deprecated
     * @var int
     */
    protected $startMonth;
    /**
     * @deprecated
     * @var int
     */
    protected $startYear;
    /**
     * @deprecated
     * @var string
     */
    protected $cvv;
    /**
     * @deprecated
     * @var string
     */
    protected $issueNumber;
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $cardHolder;

    /**
     * @var string
     */
    protected $firstSixDigits;

    /**
     * @var string
     */
    protected $binDigits;

    /**
     * @var string
     */
    protected $lastFourDigits;

    /**
     * @deprecated
     * @param $number
     *
     * @return $this
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * @param int $expiryMonth
     *
     * @return $this
     */
    public function setExpiryMonth($expiryMonth) {
        $this->expiryMonth = $expiryMonth;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiryMonth() {
        return $this->expiryMonth;
    }

    /**
     * @param int $expiryYear
     *
     * @return $this
     */
    public function setExpiryYear($expiryYear) {
        $this->expiryYear = $expiryYear;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiryYear() {
        return $this->expiryYear;
    }

    /**
     * @deprecated
     * @param int $startMonth
     *
     * @return $this
     */
    public function setStartMonth($startMonth) {
        $this->startMonth = $startMonth;
        return $this;
    }

    /**
     * @deprecated
     * @return int
     */
    public function getStartMonth() {
        return $this->startMonth;
    }

    /**
     * @deprecated
     * @param int $startYear
     *
     * @return $this
     */
    public function setStartYear($startYear) {
        $this->startYear = $startYear;
        return $this;
    }

    /**
     * @deprecated
     * @return int
     */
    public function getStartYear() {
        return $this->startYear;
    }

    /**
     * @deprecated
     * @param int $cvv
     *
     * @return $this
     */
    public function setCvv($cvv) {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getCvv() {
        return $this->cvv;
    }

    /**
     * @deprecated
     * @param string $issueNumber
     *
     * @return $this
     */
    public function setIssueNumber($issueNumber) {
        $this->issueNumber = $issueNumber;
        return $this;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getIssueNumber() {
        return $this->issueNumber;
    }

    /**
     * @deprecated
     * @param string $type
     *
     * @return $this
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     *
     * @return CreditCardCustomer
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardHolder()
    {
        return $this->cardHolder;
    }

    /**
     * @param string $cardHolder
     *
     * @return CreditCardCustomer
     */
    public function setCardHolder($cardHolder)
    {
        $this->cardHolder = $cardHolder;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstSixDigits()
    {
        return $this->firstSixDigits;
    }

    /**
     * @param string $firstSixDigits
     *
     * @return CreditCardCustomer
     */
    public function setFirstSixDigits($firstSixDigits)
    {
        $this->firstSixDigits = $firstSixDigits;
        return $this;
    }

    /**
     * @return string
     */
    public function getBinDigits() {
        return $this->binDigits;
    }

    /**
     * @param string $binDigits
     * @return CreditCardCustomer
     */
    public function setBinDigits($binDigits) {
        $this->binDigits = $binDigits;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastFourDigits()
    {
        return $this->lastFourDigits;
    }

    /**
     * @param string $lastFourDigits
     *
     * @return CreditCardCustomer
     */
    public function setLastFourDigits($lastFourDigits)
    {
        $this->lastFourDigits = $lastFourDigits;
        return $this;
    }

}
