<?php

namespace Ixopay\Client\Data;

/**
 * Specialized class to represent a customer with credit card data.
 *
 * @package Ixopay\Client\Data
 */
class CreditCardCustomer extends Customer {

    /**
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
     * @var int
     */
    protected $startMonth;
    /**
     * @var int
     */
    protected $startYear;
    /**
     * @var string
     */
    protected $cvv;
    /**
     * @var string
     */
    protected $issueNumber;
    /**
     * @var string
     */
    protected $type;

    /**
     * @param $number
     *
     * @return $this
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
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
     * @param int $startMonth
     *
     * @return $this
     */
    public function setStartMonth($startMonth) {
        $this->startMonth = $startMonth;
        return $this;
    }

    /**
     * @return int
     */
    public function getStartMonth() {
        return $this->startMonth;
    }

    /**
     * @param int $startYear
     *
     * @return $this
     */
    public function setStartYear($startYear) {
        $this->startYear = $startYear;
        return $this;
    }

    /**
     * @return int
     */
    public function getStartYear() {
        return $this->startYear;
    }

    /**
     * @param int $cvv
     *
     * @return $this
     */
    public function setCvv($cvv) {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * @return string
     */
    public function getCvv() {
        return $this->cvv;
    }

    /**
     * @param string $issueNumber
     *
     * @return $this
     */
    public function setIssueNumber($issueNumber) {
        $this->issueNumber = $issueNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getIssueNumber() {
        return $this->issueNumber;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

}