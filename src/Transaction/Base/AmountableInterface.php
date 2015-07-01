<?php


namespace Ixopay\Client\Transaction\Base;

/**
 * Interface AmountableInterface
 * @package Ixopay\Client\Transaction
 */
interface AmountableInterface {
    /**
     * @return float
     */
    public function getAmount();

    /**
     * the amount you want to charge/refund etc.
     *
     * @param float $amount
     */
    public function setAmount($amount);

    /**
     * @return string
     */
    public function getCurrency();

    /**
     * @param string $currency
     */
    public function setCurrency($currency);

}