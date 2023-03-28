<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;
use Ixopay\Client\Transaction\Base\AmountableInterface;
use Ixopay\Client\Transaction\Base\AmountableTrait;
use Ixopay\Client\Transaction\Base\ItemsInterface;
use Ixopay\Client\Transaction\Base\ItemsTrait;
use Ixopay\Client\Transaction\Base\LevelTwoAndThreeDataInterface;
use Ixopay\Client\Transaction\Base\LevelTwoAndThreeDataTrait;
use Ixopay\Client\Transaction\Base\TransactionSplitsInterface;
use Ixopay\Client\Transaction\Base\TransactionSplitsTrait;

/**
 * Capture: Charge a previously preauthorized transaction.
 *
 * @package Ixopay\Client\Transaction
 */
class Capture extends AbstractTransactionWithReference
              implements    AmountableInterface,
                            ItemsInterface,
                            TransactionSplitsInterface,
                            LevelTwoAndThreeDataInterface
{
    use AmountableTrait;
    use ItemsTrait;
    use TransactionSplitsTrait;
    use LevelTwoAndThreeDataTrait;

    /** @var string */
    protected $description;

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }
}
