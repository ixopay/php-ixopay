<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Interface LevelTwoAndThreeDataInterface
 *
 * @package Ixopay\Client\Transaction\Base
 */
interface LevelTwoAndThreeDataInterface {
    /**
     * @param float $taxAmount
     * @return void
     */
    public function setTaxAmount($taxAmount);

    /**
     * @return float
     */
    public function getTaxAmount();
}
