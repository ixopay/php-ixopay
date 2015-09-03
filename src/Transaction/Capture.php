<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;
use Ixopay\Client\Transaction\Base\AmountableInterface;
use Ixopay\Client\Transaction\Base\AmountableTrait;
use Ixopay\Client\Transaction\Base\ItemsInterface;
use Ixopay\Client\Transaction\Base\ItemsTrait;

/**
 * Capture: Charge a previously preauthorized transaction.
 *
 * @package Ixopay\Client\Transaction
 */
class Capture extends AbstractTransactionWithReference implements AmountableInterface, ItemsInterface {
    use AmountableTrait;
    use ItemsTrait;
}