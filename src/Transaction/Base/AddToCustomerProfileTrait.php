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
     * @deprecated not in use anymore
     *
     * @var bool
     */
    protected $addToCustomerProfile = false;

    /**
     * @var CustomerProfileData
     */
    protected $customerProfileData;

    /**
     * @return CustomerProfileData
     */
    public function getCustomerProfileData() {
        return $this->customerProfileData;
    }

    /**
     * @param CustomerProfileData $customerProfileData
     *
     * @return $this
     */
    public function setCustomerProfileData(CustomerProfileData $customerProfileData) {
        $this->customerProfileData = $customerProfileData;
        return $this;
    }

    /**
     * @deprecated not in use anymore
     *             sending customerProfileData will automatically add it to the customerProfile
     *
     * @return bool
     */
    public function getAddToCustomerProfile() {
        return $this->addToCustomerProfile;
    }

    /**
     * @deprecated not in use anymore
     *             sending customerProfileData will automatically add it to the customerProfile
     *
     * @param bool $addToCustomerProfile
     * @return $this
     */
    public function setAddToCustomerProfile($addToCustomerProfile) {
        $this->addToCustomerProfile = $addToCustomerProfile;
        return $this;
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @return string
     */
    public function getCustomerProfileGuid(){
        return $this->customerProfileData->getProfileGuid();
    }

    /**
     * backwards compatibility
     * @deprecated use CustomerProfileData instead
     *
     * @param string $profileGuid
     * @return $this
     */
    public function setCustomerProfileGuid($profileGuid){
        $this->customerProfileData->setProfileGuid($profileGuid);
        return $this;
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @return string
     */
    public function getCustomerProfileIdentification() {
        return $this->customerProfileData->getCustomerIdentification();
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @param string $identification
     *
     * @return $this
     */
    public function setCustomerProfileIdentification($identification) {
        $this->customerProfileData->setCustomerIdentification($identification);
        return $this;
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @return bool
     */
    public function getMarkAsPreferred() {
        return $this->customerProfileData->getMarkAsPreferred();
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @param bool $markAsPreferred
     *
     * @return $this
     */
    public function setMarkAsPreferred($markAsPreferred) {
        $this->customerProfileData->setMarkAsPreferred($markAsPreferred);
        return $this;
    }
}