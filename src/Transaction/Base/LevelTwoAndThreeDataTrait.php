<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Class LevelTwoAndThreeDataTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait LevelTwoAndThreeDataTrait {
    /** @var float $taxAmount  */
    protected $taxAmount;

    /**
     * @param float $taxAmount
     * @return void
     */
    public function setTaxAmount($taxAmount) {
        $this->taxAmount = $taxAmount;
    }

    /**
     * @return float
     */
    public function getTaxAmount() {
        return $this->taxAmount;
    }
}
