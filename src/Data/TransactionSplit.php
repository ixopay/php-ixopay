<?php


namespace Ixopay\Client\Data;


class TransactionSplit
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $transactionInternalId;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $sellerMerchantGuid;

    /**
     * @var string
     */
    private $sellerMerchantExternalId;

    /** @var string */
    private $commissionFeeAmount;

    /** @var string */
    private $commissionFeeCurrency;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTransactionInternalId()
    {
        return $this->transactionInternalId;
    }

    /**
     * @param string $transactionInternalId
     */
    public function setTransactionInternalId($transactionInternalId)
    {
        $this->transactionInternalId = $transactionInternalId;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getSellerMerchantGuid()
    {
        return $this->sellerMerchantGuid;
    }

    /**
     * @param string $sellerMerchantGuid
     */
    public function setSellerMerchantGuid($sellerMerchantGuid)
    {
        $this->sellerMerchantGuid = $sellerMerchantGuid;
    }

    /**
     * @return string
     */
    public function getSellerMerchantExternalId()
    {
        return $this->sellerMerchantExternalId;
    }

    /**
     * @param string $sellerMerchantExternalId
     */
    public function setSellerMerchantExternalId($sellerMerchantExternalId)
    {
        $this->sellerMerchantExternalId = $sellerMerchantExternalId;
    }

    /**
     * @return string
     */
    public function getCommissionFeeAmount()
    {
        return $this->commissionFeeAmount;
    }

    /**
     * @param string $commissionFeeAmount
     */
    public function setCommissionFeeAmount($commissionFeeAmount)
    {
        $this->commissionFeeAmount = $commissionFeeAmount;
    }

    /**
     * @return string
     */
    public function getCommissionFeeCurrency()
    {
        return $this->commissionFeeCurrency;
    }

    /**
     * @param string $commissionFeeCurrency
     */
    public function setCommissionFeeCurrency($commissionFeeCurrency)
    {
        $this->commissionFeeCurrency = $commissionFeeCurrency;
    }
}
