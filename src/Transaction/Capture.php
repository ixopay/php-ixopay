<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;
use Ixopay\Client\Transaction\Base\AmountableInterface;
use Ixopay\Client\Transaction\Base\AmountableTrait;

/**
 * Capture: Charge a previously preauthorized transaction.
 *
 * @package Ixopay\Client\Transaction
 */
class Capture extends AbstractTransactionWithReference implements AmountableInterface {
    use AmountableTrait;
}