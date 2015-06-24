<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;
use Ixopay\Client\Transaction\Base\AmountableInterface;
use Ixopay\Client\Transaction\Base\AmountableTrait;

/**
 * Class Refund
 * @package Ixopay\Client\Transaction
 */
class Refund extends AbstractTransactionWithReference implements AmountableInterface{
    use AmountableTrait;
}