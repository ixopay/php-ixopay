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