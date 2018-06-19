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
     * @var string
     */
    protected $merchantFingerprint;
    /**
     * @var string
     */
    protected $binBrand;
    /**
     * @var string
     */
    protected $binBank;
    /**
     * @var string
     */
    protected $binType;
    /**
     * @var string
     */
    protected $binLevel;
    /**
     * @var string
     */
    protected $binCountry2Iso;
    /**
     * @var string
     */
    protected $eciFlag;
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

    /**
     * @return string
     */
    public function getMerchantFingerprint()
    {
        return $this->merchantFingerprint;
    }

    /**
     * @param string $merchantFingerprint
     */
    public function setMerchantFingerprint($merchantFingerprint)
    {
        $this->merchantFingerprint = $merchantFingerprint;
    }

    /**
     * @return string
     */
    public function getBinBrand()
    {
        return $this->binBrand;
    }

    /**
     * @param string $binBrand
     */
    public function setBinBrand($binBrand)
    {
        $this->binBrand = $binBrand;
    }

    /**
     * @return string
     */
    public function getBinBank()
    {
        return $this->binBank;
    }

    /**
     * @param string $binBank
     */
    public function setBinBank($binBank)
    {
        $this->binBank = $binBank;
    }

    /**
     * @return string
     */
    public function getBinType()
    {
        return $this->binType;
    }

    /**
     * @param string $binType
     */
    public function setBinType($binType)
    {
        $this->binType = $binType;
    }

    /**
     * @return string
     */
    public function getBinLevel()
    {
        return $this->binLevel;
    }

    /**
     * @param string $binLevel
     */
    public function setBinLevel($binLevel)
    {
        $this->binLevel = $binLevel;
    }

    /**
     * @return string
     */
    public function getBinCountry2Iso()
    {
        return $this->binCountry2Iso;
    }

    /**
     * @param string $binCountry2Iso
     */
    public function setBinCountry2Iso($binCountry2Iso)
    {
        $this->binCountry2Iso = $binCountry2Iso;
    }

    /**
     * @return string
     */
    public function getEciFlag()
    {
        return $this->eciFlag;
    }

    /**
     * @param string $eciFlag
     */
    public function setEciFlag($eciFlag)
    {
        $this->eciFlag = $eciFlag;
    }

}