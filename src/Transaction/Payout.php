<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;
use Ixopay\Client\Transaction\Base\AmountableInterface;
use Ixopay\Client\Transaction\Base\AmountableTrait;
use Ixopay\Client\Transaction\Base\CustomerInterface;
use Ixopay\Client\Transaction\Base\CustomerTrait;
use Ixopay\Client\Transaction\Base\ItemsInterface;
use Ixopay\Client\Transaction\Base\ItemsTrait;
use Ixopay\Client\Transaction\Base\TransactionSplitsInterface;
use Ixopay\Client\Transaction\Base\TransactionSplitsTrait;

/**
 * Payout: Payout a certain amount of money to the customer. (Debits the merchant's account, Credits the customer's account)
 *
 * @package Ixopay\Client\Transaction
 */
class Payout extends AbstractTransactionWithReference
             implements AmountableInterface,
                        CustomerInterface,
                        ItemsInterface,
                        TransactionSplitsInterface
{

    use AmountableTrait;
    use CustomerTrait;
    use ItemsTrait;
    use TransactionSplitsTrait;

    /** @var string */
    protected $callbackUrl;

    /** @var string */
    protected $transactionToken;

    /** @var string */
    protected $description;

    /** @var string */
    protected $language;

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

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

}
