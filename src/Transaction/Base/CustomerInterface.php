<?php

namespace Ixopay\Client\Transaction\Base;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\ThreeDSecureData;

/**
 * Interface CustomerInterface
 *
 * @package Ixopay\Client\Transaction\Base
 */
interface CustomerInterface {

    /**
     * @return Customer
     */
    public function getCustomer();

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer);

}