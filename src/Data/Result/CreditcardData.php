<?php

namespace Ixopay\Client\Data\Result;

/**
 * Represents a credit card.
 *
 * @package Ixopay\Client\Data
 */
class CreditcardData extends ResultData {

    //global cards
    const TYPE_VISA = 'visa';
    const TYPE_MASTERCARD = 'mastercard';
    const TYPE_AMEX = 'amex';
    const TYPE_DINERS = 'diners';

    //regional cards
    const TYPE_UNIONPAY = 'unionpay';
    const TYPE_DINACARD = 'dinacard';
    const TYPE_DISCOVER = 'discover';
    const TYPE_JCB = 'jcb';
    const TYPE_HIPERCARD = 'hipercard';
    const TYPE_TRANSCARD = 'transcard';

    const SECURE_3D_MANDATORY = 'MANDATORY';
    const SECURE_3D_OPTIONAL = 'OPTIONAL';
    const SECURE_3D_OFF = 'OFF';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $cardHolder;

    /**
     * @var int
     */
    protected $expiryMonth;

    /**
     * @var int
     */
    protected $expiryYear;

    /**
     * @var string
     */
    protected $binDigits;

    /**
     * @var string
     */
    protected $lastFourDigits;

    /**
     * @var string
     */
    protected $fingerprint;

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
    protected $binCountry;

    /**
     * @var string
     */
    protected $threeDSecure;

    /**
     * @var string
     */
    protected $eci;

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
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
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardHolder() {
        return $this->cardHolder;
    }

    /**
     * @param string $cardHolder
     *
     * @return $this
     */
    public function setCardHolder($cardHolder) {
        $this->cardHolder = $cardHolder;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiryMonth() {
        return $this->expiryMonth;
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
    public function getExpiryYear() {
        return $this->expiryYear;
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
     * @return string
     */
    public function getBinDigits() {
        return $this->binDigits;
    }

    /**
     * @param string $binDigits
     * @return CreditcardData
     */
    public function setBinDigits($binDigits) {
        $this->binDigits = $binDigits;
        return $this;
    }

    /**
     * Because of an adjustment from VISA
     *
     * @deprecated use getBinDigits
     * @return string
     */
    public function getFirstSixDigits() {
        return substr($this->getBinDigits(), 0, 6);
    }

    /**
     * @param string $firstSixDigits
     * @deprecated use setBinDigits
     * @return $this
     */
    public function setFirstSixDigits($firstSixDigits) {
        return $this->setBinDigits($firstSixDigits);
    }

    /**
     * @return string
     */
    public function getLastFourDigits() {
        return $this->lastFourDigits;
    }

    /**
     * @param string $lastFourDigits
     *
     * @return $this
     */
    public function setLastFourDigits($lastFourDigits) {
        $this->lastFourDigits = $lastFourDigits;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getFingerprint()
    {
        return $this->fingerprint;
    }

    /**
     * @param string $fingerprint
     * @return $this
     */
    public function setFingerprint($fingerprint)
    {
        $this->fingerprint = $fingerprint;
        return $this;
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
     * @return $this
     */
    public function setBinBrand($binBrand)
    {
        $this->binBrand = $binBrand;
        return $this;
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
     * @return $this
     */
    public function setBinBank($binBank)
    {
        $this->binBank = $binBank;
        return $this;
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
     * @return $this
     */
    public function setBinType($binType)
    {
        $this->binType = $binType;
        return $this;
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
     * @return $this
     */
    public function setBinLevel($binLevel)
    {
        $this->binLevel = $binLevel;
        return $this;
    }

    /**
     * @return string
     */
    public function getBinCountry() {
        return $this->binCountry;
    }

    /**
     * @param string $binCountry
     * @return $this
     */
    public function setBinCountry($binCountry) {
        $this->binCountry = $binCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getThreeDSecure() {
        return $this->threeDSecure;
    }

    /**
     * @param string $threeDSecure
     * @return $this
     */
    public function setThreeDSecure($threeDSecure) {
        $this->threeDSecure = $threeDSecure;
        return $this;
    }

    /**
     * @return string
     */
    public function getEci()
    {
        return $this->eci;
    }

    /**
     * @param string $eci
     * @return $this
     */
    public function setEci($eci)
    {
        $this->eci = $eci;
        return $this;
    }


    /**
     * @return array
     */
    public function toArray() {
        $resultData = array();

        foreach ($this as $field => $value) {
            $resultData[$field] = $value;
        }
        // Property $firstSixDigits was removed because of the implementation of
        // binDigits. For backwards compatibility this will be set directly.
        $resultData['firstSixDigits'] = $this->getFirstSixDigits();

        return $resultData;
    }

}
