<?php

namespace Ixopay\Client\Transaction;

use IxopayV2\Transaction\Base\AbstractTransactionWithReference;
use IxopayV2\Transaction\Base\AmountableInterface;
use IxopayV2\Transaction\Base\AmountableTrait;

/**
 * Class Capture
 * @package Ixopay\Client\Transaction
 */
class Capture extends AbstractTransactionWithReference implements AmountableInterface {
    use AmountableTrait;


}