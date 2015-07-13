<?php

namespace Ixopay\Client\Callback;

/**
 * Class ChargebackData
 *
 * @package Ixopay\Client\Callback
 */
class ChargebackData {

    /**
     * @var string
     */
    protected $originalTransactionId;

    /**
     * @var string
     */
    protected $originalReferenceId;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var \DateTime
     */
    protected $chargebackDateTime;

    /**
     * @return string
     */
    public function getOriginalTransactionId() {
        return $this->originalTransactionId;
    }

    /**
     * @param string $originalTransactionId
     */
    public function setOriginalTransactionId($originalTransactionId) {
        $this->originalTransactionId = $originalTransactionId;
    }

    /**
     * @return string
     */
    public function getOriginalReferenceId() {
        return $this->originalReferenceId;
    }

    /**
     * @param string $originalReferenceId
     */
    public function setOriginalReferenceId($originalReferenceId) {
        $this->originalReferenceId = $originalReferenceId;
    }

    /**
     * @return float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    /**
     * @return \DateTime
     */
    public function getChargebackDateTime() {
        return $this->chargebackDateTime;
    }

    /**
     * @param \DateTime $chargebackDateTime
     */
    public function setChargebackDateTime(\DateTime $chargebackDateTime) {
        $this->chargebackDateTime = $chargebackDateTime;
    }
}