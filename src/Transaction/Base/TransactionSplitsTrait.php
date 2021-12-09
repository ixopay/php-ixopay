<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\TransactionSplit;

/**
 * Class ItemsTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait TransactionSplitsTrait {

    /** @var TransactionSplit[]  */
    protected $transactionSplits = array();

    /**
     * @param TransactionSplit[] $transactionSplits
     * @return void
     */
    public function setTransactionSplits($transactionSplits) {
        $this->transactionSplits = $transactionSplits;
    }

    /**
     * @return TransactionSplit[]
     */
    public function getTransactionSplits() {
        return $this->transactionSplits;
    }

    /**
     * @param TransactionSplit $transactionSplit
     *
     * @return void
     */
    public function addTransactionSplit($transactionSplit) {
        $this->transactionSplits[] = $transactionSplit;
    }
}
