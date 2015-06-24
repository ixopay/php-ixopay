<?php

namespace Ixopay\Client\Data;

/**
 * Class Customer
 * @package Ixopay\Client\Data
 */
class Customer {

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
     * @var string
     */
    protected $ipAddress;

    /**
     * like social insurance number or equivalents
     * @var string
     */
    protected $nationalId;

    /**
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @param string $identification
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
        return $this;
    }

    /**
     * @param $firstName
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
     * @param $lastName
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
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }


    /**
     * @param $billingAddress1
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
     * @param $billingAddress2
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
     * @param $billingCity
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
     * @param $billingPostcode
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
     * @param $billingState
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
     * @param $billingCountry
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
     * @param $billingPhone
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
     * @param $shippingAddress1
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
     * @param $shippingAddress2
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
     * @param $shippingCity
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
     * @param $shippingPostcode
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
     * @param $shippingState
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
     * @param $shippingCountry
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
     * @param $shippingPhone
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
     * @param $company
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
     * @param $email
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
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return string
     */
    public function getNationalId() {
        return $this->nationalId;
    }

    /**
     * @param string $nationalId
     */
    public function setNationalId($nationalId) {
        $this->nationalId = $nationalId;
    }
}