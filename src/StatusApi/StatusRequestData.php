<?php

namespace Ixopay\Client\StatusApi;

use Ixopay\Client\Exception\TypeException;

/**
 * Class StatusRequestData
 *
 * @package Ixopay\Client\StatusApi
 */
class StatusRequestData {

    /**
     * the referenceId received by the transaction response
     *
     * @var string -
     */
    protected $transactionUuid;

    /**
     * the transactionId sent with the transaction request
     *
     * @var string -
     */
    protected $merchantTransactionId;

    /**
     * StatusRequestData constructor.
     *
     * @param string $transactionUuid
     */
    public function __construct($transactionUuid = null) {
        $this->transactionUuid = $transactionUuid;
    }

    /**
     * @return string
     */
    public function getTransactionUuid() {
        return $this->transactionUuid;
    }

    /**
     * @param string $transactionUuid
     *
     * @return StatusRequestData
     */
    public function setTransactionUuid($transactionUuid) {
        $this->transactionUuid = $transactionUuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantTransactionId() {
        return $this->merchantTransactionId;
    }

    /**
     * @param string $merchantTransactionId
     *
     * @return StatusRequestData
     */
    public function setMerchantTransactionId($merchantTransactionId) {
        $this->merchantTransactionId = $merchantTransactionId;

        return $this;
    }

    /**
     * @throws TypeException
     */
    public function validate() {
        if (empty($this->transactionUuid) && empty($this->merchantTransactionId)) {
            throw new TypeException('Either transactionUuid or merchantTransactionId must be set.');
        }
        if (!empty($this->transactionUuid) && !empty($this->merchantTransactionId)) {
            throw new TypeException('Either transactionUuid or merchantTransactionId must be set but not both.');
        }
    }

}