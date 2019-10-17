<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\Customer;

/**
 * Class ThreeDSecureTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait CustomerTrait {

    /** @var Customer */
    protected $customer;

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

}