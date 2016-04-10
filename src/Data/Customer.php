<?php

namespace Ixopay\Client\Data;

/**
 * Represents a generic customer without any specific data.
 *
 * @package Ixopay\Client\Data
 */
class Customer extends Data {

    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';

    /**
     * @var string
     */
    protected $identification;

    /**
     * @var string
     */
    protected $firstName;
    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var \DateTime
     */
    protected $birthDate;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var string
     */
    protected $billingAddress1;
    /**
     * @var string
     */
    protected $billingAddress2;
    /**
     * @var string
     */
    protected $billingCity;
    /**
     * @var string
     */
    protected $billingPostcode;
    /**
     * @var string
     */
    protected $billingState;
    /**
     * @var string
     */
    protected $billingCountry;
    /**
     * @var string
     */
    protected $billingPhone;
    /**
     * @var string
     */
    protected $shippingFirstName;
    /**
     * @var string
     */
    protected $shippingLastName;
    /**
     * @var string
     */
    protected $shippingCompany;
    /**
     * @var string
     */
    protected $shippingAddress1;
    /**
     * @var string
     */
    protected $shippingAddress2;
    /**
     * @var string
     */
    protected $shippingCity;
    /**
     * @var string
     */
    protected $shippingPostcode;
    /**
     * @var string
     */
    protected $shippingState;
    /**
     * @var string
     */
    protected $shippingCountry;
    /**
     * @var string
     */
    protected $shippingPhone;
    /**
     * @var string
     */
    protected $company;
    /**
     * @var string
     */
    protected $email;

    /**
     * @var bool
     */
    protected $emailVerified;

    /**
     * @var string
     */
    protected $ipAddress;

    /**
     * like social insurance number or equivalents
     *
     * @var string
     */
    protected $nationalId;

    /**
     * @return string
     */
    public function getIdentification() {
        return $this->identification;
    }

    /**
     * @param string $identification
     *
     * @return $this
     */
    public function setIdentification($identification) {
        $this->identification = $identification;
        return $this;
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
    public function getFirstName() {
        return $this->firstName;
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
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate() {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     *
     * @return $this
     */
    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
        return $this;
    }


    /**
     * @param string $billingAddress1
     *
     * @return $this
     */
    public function setBillingAddress1($billingAddress1) {
        $this->billingAddress1 = $billingAddress1;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddress1() {
        return $this->billingAddress1;
    }

    /**
     * @param string $billingAddress2
     *
     * @return $this
     */
    public function setBillingAddress2($billingAddress2) {
        $this->billingAddress2 = $billingAddress2;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddress2() {
        return $this->billingAddress2;
    }

    /**
     * @param string $billingCity
     *
     * @return $this
     */
    public function setBillingCity($billingCity) {
        $this->billingCity = $billingCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingCity() {
        return $this->billingCity;
    }

    /**
     * @param string $billingPostcode
     *
     * @return $this
     */
    public function setBillingPostcode($billingPostcode) {
        $this->billingPostcode = $billingPostcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingPostcode() {
        return $this->billingPostcode;
    }

    /**
     * @param string $billingState
     *
     * @return $this
     */
    public function setBillingState($billingState) {
        $this->billingState = $billingState;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingState() {
        return $this->billingState;
    }

    /**
     * @param string $billingCountry
     *
     * @return $this
     */
    public function setBillingCountry($billingCountry) {
        $this->billingCountry = $billingCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingCountry() {
        return $this->billingCountry;
    }

    /**
     * @param string $billingPhone
     *
     * @return $this
     */
    public function setBillingPhone($billingPhone) {
        $this->billingPhone = $billingPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingPhone() {
        return $this->billingPhone;
    }

    /**
     * @param string $shippingAddress1
     *
     * @return $this
     */
    public function setShippingAddress1($shippingAddress1) {
        $this->shippingAddress1 = $shippingAddress1;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAddress1() {
        return $this->shippingAddress1;
    }

    /**
     * @param string $shippingAddress2
     *
     * @return $this
     */
    public function setShippingAddress2($shippingAddress2) {
        $this->shippingAddress2 = $shippingAddress2;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAddress2() {
        return $this->shippingAddress2;
    }

    /**
     * @param string $shippingCity
     *
     * @return $this
     */
    public function setShippingCity($shippingCity) {
        $this->shippingCity = $shippingCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCity() {
        return $this->shippingCity;
    }

    /**
     * @param string $shippingPostcode
     *
     * @return $this
     */
    public function setShippingPostcode($shippingPostcode) {
        $this->shippingPostcode = $shippingPostcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingPostcode() {
        return $this->shippingPostcode;
    }

    /**
     * @param string $shippingState
     *
     * @return $this
     */
    public function setShippingState($shippingState) {
        $this->shippingState = $shippingState;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingState() {
        return $this->shippingState;
    }

    /**
     * @param string $shippingCountry
     *
     * @return $this
     */
    public function setShippingCountry($shippingCountry) {
        $this->shippingCountry = $shippingCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCountry() {
        return $this->shippingCountry;
    }

    /**
     * @param string $shippingPhone
     *
     * @return $this
     */
    public function setShippingPhone($shippingPhone) {
        $this->shippingPhone = $shippingPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingPhone() {
        return $this->shippingPhone;
    }

    /**
     * @param string $company
     *
     * @return $this
     */
    public function setCompany($company) {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany() {
        return $this->company;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return boolean
     */
    public function isEmailVerified() {
        return $this->emailVerified;
    }

    /**
     * @param boolean $emailVerified
     * @return $this
     */
    public function setEmailVerified($emailVerified) {
        $this->emailVerified = $emailVerified;
        return $this;
    }

    /**
     * @return string
     */
    public function getIpAddress() {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     *
     * @return $this
     */
    public function setIpAddress($ipAddress) {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getNationalId() {
        return $this->nationalId;
    }

    /**
     * @param string $nationalId
     *
     * @return $this
     */
    public function setNationalId($nationalId) {
        $this->nationalId = $nationalId;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return $this
     */
    public function setGender($gender) {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingFirstName() {
        return $this->shippingFirstName;
    }

    /**
     * @param string $shippingFirstName
     * @return $this
     */
    public function setShippingFirstName($shippingFirstName) {
        $this->shippingFirstName = $shippingFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingLastName() {
        return $this->shippingLastName;
    }

    /**
     * @param string $shippingLastName
     * @return $this
     */
    public function setShippingLastName($shippingLastName) {
        $this->shippingLastName = $shippingLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCompany() {
        return $this->shippingCompany;
    }

    /**
     * @param string $shippingCompany
     * @return $this
     */
    public function setShippingCompany($shippingCompany) {
        $this->shippingCompany = $shippingCompany;
        return $this;
    }

}
