<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\CustomerProfileData;

/**
 * Trait AddToCustomerProfileTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait AddToCustomerProfileTrait {

    /**
     * @var bool
     */
    protected $addToCustomerProfile = false;

    /**
     * @var CustomerProfileData
     */
    protected $customerProfileData;

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
     * @return CustomerProfileData
     */
    public function getCustomerProfileData() {
        return $this->customerProfileData;
    }

    /**
     * @param CustomerProfileData $customerProfileData
     *
     * @return AddToCustomerProfileTrait
     */
    public function setCustomerProfileData($customerProfileData) {
        $this->customerProfileData = $customerProfileData;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerProfileGuid(){
        return $this->customerProfileData->getProfileGuid();
    }

    /**
     * @param string $profileGuid
     *
     * @return AddToCustomerProfileTrait
     */
    public function setCustomerProfileGuid($profileGuid){
        $this->customerProfileData->setProfileGuid($profileGuid);
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerProfileIdentification() {
        return $this->customerProfileData->getCustomerIdentification();
    }

    /**
     * @param string $identification
     *
     * @return AddToCustomerProfileTrait
     */
    public function setCustomerProfileIdentification($identification) {
        $this->customerProfileData->setCustomerIdentification($identification);
        return $this;
    }

    /**
     * @return bool
     */
    public function getMarkAsPreferred() {
        return $this->customerProfileData->getMarkAsPreferred();
    }

    /**
     * @param bool $markAsPreferred
     *
     * @return AddToCustomerProfileTrait
     */
    public function setMarkAsPreferred($markAsPreferred) {
        $this->customerProfileData->setMarkAsPreferred($markAsPreferred);
        return $this;
    }
}