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
 * Refund: Refund money from a previous Debit (or Capture) transaction to the customer.
 *
 * @note Preauthorized transactions can be reverted with a Void transaction, not a Refund!
 *
 * @package Ixopay\Client\Transaction
 */
class Refund extends AbstractTransactionWithReference
             implements AmountableInterface,
                        ItemsInterface,
                        TransactionSplitsInterface,
                        LevelTwoAndThreeDataInterface
{
    use AmountableTrait;
    use ItemsTrait;
    use TransactionSplitsTrait;
    use LevelTwoAndThreeDataTrait;

    /** @var string */
    protected $callbackUrl;

    /** @var string */
    protected $transactionToken;

    /** @var string */
    protected $description;

    /**
     * @return string
     */
    public function getCallbackUrl() {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl($callbackUrl) {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return string
     */
    public function getTransactionToken()
    {
        return $this->transactionToken;
    }

    /**
     * @param string $transactionToken
     */
    public function setTransactionToken($transactionToken)
    {
        $this->transactionToken = $transactionToken;
    }

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
