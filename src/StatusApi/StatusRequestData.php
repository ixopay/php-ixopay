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
     * @deprecated use $uuid
     *
     * the referenceId received by the transaction response
     *
     * @var string -
     */
    protected $transactionUuid;

    /**
     * the referenceId received by the transaction response
     *
     * @var string
     */
    protected $uuid;

    /**
     * the transactionId sent with the transaction request
     *
     * @var string -
     */
    protected $merchantTransactionId;

    /**
     * StatusRequestData constructor.
     *
     * @param null $uuid
     */
    public function __construct($uuid = null) {
        $this->uuid = $uuid;
    }

    /**
     * @deprecated use getUuid()
     *
     * @return string
     */
    public function getTransactionUuid() {
        return $this->uuid;
    }

    /**
     * @deprecated use setUuid()
     *
     * @param string $transactionUuid
     *
     * @return StatusRequestData
     */
    public function setTransactionUuid($transactionUuid) {
        $this->uuid = $transactionUuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     *
     * @return StatusRequestData
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
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
        if (empty($this->uuid) && empty($this->merchantTransactionId)) {
            throw new TypeException('Either transactionUuid or merchantTransactionId must be set.');
        }
        if (!empty($this->uuid) && !empty($this->merchantTransactionId)) {
            throw new TypeException('Either transactionUuid or merchantTransactionId must be set but not both.');
        }
    }

}