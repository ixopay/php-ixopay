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
 * Class Preauthorize
 * @package IxopayV2\Transaction
 */
class IncrementalAuthorization extends AbstractTransactionWithReference implements AmountableInterface, OffsiteInterface, ItemsInterface {
    use OffsiteTrait;
    use AmountableTrait;
    use ItemsTrait;

    /**
     * @var string
     */
    protected $transactionIndicator;

    /**
     * @return string
     */
    public function getTransactionIndicator() {
        return $this->transactionIndicator;
    }

    /**
     * @param string $transactionIndicator
     */
    public function setTransactionIndicator($transactionIndicator) {
        $this->transactionIndicator = $transactionIndicator;
    }

    /**
     * @return string
     */
    public function getTransactionMethod() {
        return self::TRANSACTION_METHOD_INCREMENTAL_AUTHORIZATION;
    }
}