<?php

namespace Ixopay\Client\Data;

use Ixopay\Client\Json\DataObject;

/**
 * Class CustomerProfileData
 *
 * @package Ixopay\Client\Data
 */
class CustomerProfileData extends DataObject {

    /**
     * @var string
     */
    protected $profileGuid;

    /**
     * @var string
     */
    protected $customerIdentification;

    /**
     * @var string|null
     */
    protected $paymentToken;

    /**
     * @var boolean
     */
    protected $markAsPreferred;

    /**
     * @return string
     */
    public function getProfileGuid()
    {
        return $this->profileGuid;
    }

    /**
     * @param string $profileGuid
     *
     * @return CustomerProfileData
     */
    public function setProfileGuid($profileGuid)
    {
        $this->profileGuid = $profileGuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerIdentification()
    {
        return $this->customerIdentification;
    }

    /**
     * @param string $customerIdentification
     *
     * @return CustomerProfileData
     */
    public function setCustomerIdentification($customerIdentification)
    {
        $this->customerIdentification = $customerIdentification;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentToken()
    {
        return $this->paymentToken;
    }

    /**
     * @param string|null $paymentToken
     *
     * @return CustomerProfileData
     */
    public function setPaymentToken($paymentToken)
    {
        $this->paymentToken = $paymentToken;
        return $this;
    }

    /**
     * @return bool
     */
    public function getMarkAsPreferred()
    {
        return $this->markAsPreferred;
    }

    /**
     * @param bool $markAsPreferred
     *
     * @return CustomerProfileData
     */
    public function setMarkAsPreferred($markAsPreferred)
    {
        $this->markAsPreferred = $markAsPreferred;
        return $this;
    }
}
