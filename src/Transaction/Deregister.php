<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;

/**
 * Deregister: Cancels the registration from a previous Register call.
 *
 * @package Ixopay\Client\Transaction
 */
class Deregister extends AbstractTransactionWithReference {


    const TOKEN_TYPE_ALL = 'ALL';
    const TOKEN_TYPE_NT = 'NT';
    const DEREGISTER_TYPE_PAN = 'PAN';

    /** @var string */
    protected $transactionToken;

    /** @var string */
    private $tokenType = self::TOKEN_TYPE_ALL;

    /**
     * Set the DeregisterType for partially deregistering a network token or PAN only
     * @param string $tokenType
     * @return Deregister
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
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
        return $this;
    }

}
