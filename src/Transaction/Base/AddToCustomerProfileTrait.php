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
     * @var CustomerProfileData|null
     */
    protected $customerProfileData;

    /**
     * @return CustomerProfileData
     */
    public function getCustomerProfileData() {
        return $this->customerProfileData;
    }

    /**
     * @param ?CustomerProfileData|null $customerProfileData
     *
     * @return $this
     */
    public function setCustomerProfileData(?CustomerProfileData $customerProfileData = null)
    {
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
        return $this->customerProfileData ? $this->customerProfileData->getProfileGuid() : null;
    }

    /**
     * backwards compatibility
     * @deprecated use CustomerProfileData instead
     *
     * @param string $profileGuid
     * @return $this
     */
    public function setCustomerProfileGuid($profileGuid){
        if ($profileGuid && !$this->customerProfileData) {
            $this->customerProfileData = new CustomerProfileData();
            $this->customerProfileData->setProfileGuid($profileGuid);
        }
        return $this;
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @return string
     */
    public function getCustomerProfileIdentification() {
        return $this->customerProfileData ? $this->customerProfileData->getCustomerIdentification() : null;
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @param string $identification
     *
     * @return $this
     */
    public function setCustomerProfileIdentification($identification) {
        if ($identification && !$this->customerProfileData) {
            $this->customerProfileData = new CustomerProfileData();
            $this->customerProfileData->setCustomerIdentification($identification);
        }
        return $this;
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @return bool
     */
    public function getMarkAsPreferred() {
        return $this->customerProfileData ? $this->customerProfileData->getMarkAsPreferred() : false;
    }

    /**
     * @deprecated use CustomerProfileData instead
     *
     * @param bool $markAsPreferred
     *
     * @return $this
     */
    public function setMarkAsPreferred($markAsPreferred) {
        if ($markAsPreferred !== null && !$this->customerProfileData) {
            $this->customerProfileData = new CustomerProfileData();
            $this->customerProfileData->setMarkAsPreferred($markAsPreferred);
        }
        return $this;
    }
}
