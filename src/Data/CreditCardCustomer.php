<?php

namespace Ixopay\Client\Data;

/**
 * Class CreditCardCustomer
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
     * @param $expiryMonth
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
     * @param $expiryYear
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
     * @param $startMonth
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
     * @param $startYear
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
     * @param $cvv
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
     * @param $issueNumber
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
     * @param $type
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