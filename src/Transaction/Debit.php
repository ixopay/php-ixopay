<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;
use Ixopay\Client\Transaction\Base\AmountableInterface;
use Ixopay\Client\Transaction\Base\AmountableTrait;
use Ixopay\Client\Transaction\Base\ItemsInterface;
use Ixopay\Client\Transaction\Base\ItemsTrait;
use Ixopay\Client\Transaction\Base\OffsiteInterface;
use Ixopay\Client\Transaction\Base\OffsiteTrait;

/**
 * Debit: Charge the customer for a certain amount of money. This could be once, but also recurring.
 *
 * @package Ixopay\Client\Transaction
 */
class Debit extends AbstractTransactionWithReference implements AmountableInterface, OffsiteInterface, ItemsInterface {
    use OffsiteTrait;
    use AmountableTrait;
    use ItemsTrait;

    /**
     * @var bool
     */
    protected $withRegister = false;

    /**
     * @return boolean
     */
    public function isWithRegister() {
        return $this->withRegister;
    }

    /**
     * set true if you want to register a user vault together with the debit
     *
     * @param boolean $withRegister
     *
     * @return $this
     */
    public function setWithRegister($withRegister) {
        $this->withRegister = $withRegister;
        return $this;
    }

}