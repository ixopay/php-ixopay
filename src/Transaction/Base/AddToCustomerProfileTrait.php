<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Trait AddToCustomerProfileTrait
 * @package Ixopay\Client\Transaction\Base
 */
trait AddToCustomerProfileTrait {

    /**
     * @var bool
     */
    protected $addToCustomerProfile = false;

    /**
     * @var string
     */
    protected $customerProfileGuid;

    /**
     * @var string
     */
    protected $customerProfileIdentification;

    /**
     * @var string
     */
    protected $markAsPrefrred;

    /**
     * @return bool
     */
    public function getAddToCustomerProfile() {
        return $this->addToCustomerProfile;
    }

    /**
     * @param bool $addToCustomerProfile
     * @return AddToCustomerProfileTrait
     */
    public function setAddToCustomerProfile($addToCustomerProfile) {
        $this->addToCustomerProfile = $addToCustomerProfile;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerProfileGuid() {
        return $this->customerProfileGuid;
    }

    /**
     * @param string $customerProfileGuid
     * @return AddToCustomerProfileTrait
     */
    public function setCustomerProfileGuid($customerProfileGuid) {
        $this->customerProfileGuid = $customerProfileGuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerProfileIdentification() {
        return $this->customerProfileIdentification;
    }

    /**
     * @param string $customerProfileIdentification
     * @return AddToCustomerProfileTrait
     */
    public function setCustomerProfileIdentification($customerProfileIdentification) {
        $this->customerProfileIdentification = $customerProfileIdentification;
        return $this;
    }

    /**
     * @return string
     */
    public function getMarkAsPrefrred() {
        return $this->markAsPrefrred;
    }

    /**
     * @param string $markAsPrefrred
     * @return AddToCustomerProfileTrait
     */
    public function setMarkAsPrefrred($markAsPrefrred) {
        $this->markAsPrefrred = $markAsPrefrred;
        return $this;
    }

}