<?php

namespace Ixopay\Client\Transaction\Base;
use Ixopay\Client\Data\TransactionSplit;

/**
 * Interface SplitsInterface
 *
 * @package Ixopay\Client\Transaction\Base
 */
interface TransactionSplitsInterface {

    /**
     * @param TransactionSplit[] $transactionSplits
     * @return void
     */
    public function setTransactionSplits($transactionSplits);

    /**
     * @return TransactionSplit[]
     */
    public function getTransactionSplits();

    /**
     * @param TransactionSplit $transactionSplit
     * @return void
     */
    public function addTransactionSplit(TransactionSplit $transactionSplit);

}
