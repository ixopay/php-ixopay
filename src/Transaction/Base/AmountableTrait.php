<?php


namespace Ixopay\Client\Transaction\Base;

/**
 * Class AmountableTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait AmountableTrait {

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @return mixed
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * the amount you want to charge/refund etc.
     *
     * @param mixed $amount
     *
     * @return $this
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * The currency code to charge/refund in.
     *
     * @param mixed $currency
     *
     * @return $this
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }
}