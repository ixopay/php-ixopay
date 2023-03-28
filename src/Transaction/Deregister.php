<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;

/**
 * Deregister: Cancels the registration from a previous Register call.
 *
 * @package Ixopay\Client\Transaction
 */
class Deregister extends AbstractTransactionWithReference {

    /** @var string */
    protected $transactionToken;


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
        return $this;
    }

}
