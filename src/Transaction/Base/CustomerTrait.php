<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\CreditCardCustomer;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\IbanCustomer;

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
     * with backward compatibility for IbanCustomer/CreditCardCustomer
     * @param IbanCustomer|CreditCardCustomer|Customer $customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

}