<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransaction;
use Ixopay\Client\Transaction\Base\AmountableInterface;
use Ixopay\Client\Transaction\Base\AmountableTrait;
use Ixopay\Client\Transaction\Base\OffsiteInterface;
use Ixopay\Client\Transaction\Base\OffsiteTrait;

/**
 * Class Preauthorize
 * @package Ixopay\Client\Transaction
 */
class Preauthorize extends AbstractTransaction implements AmountableInterface, OffsiteInterface {
    use OffsiteTrait;
    use AmountableTrait;

    /**
     * @var bool
     */
    protected $withRegister = false;

    /**
     * @return boolean
     */
    public function isWithRegister()
    {
        return $this->withRegister;
    }

    /**
     * @param boolean $withRegister
     */
    public function setWithRegister($withRegister)
    {
        $this->withRegister = $withRegister;
    }

}