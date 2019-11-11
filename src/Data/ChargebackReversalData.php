<?php

namespace Ixopay\Client\Data;

/**
 * Class ChargebackReversalData
 *
 * @package Ixopay\Client\Data
 */
class ChargebackReversalData {

    /**
     * @deprecated use originalUuid
     * @var string
     */
    protected $originalTransactionId;

    /**
     * @var string
     */
    protected $originalUuid;

    /**
     * @deprecated use originalReferenceUuid
     * @var string
     */
    protected $originalReferenceId;

    /**
     * @var string
     */
    protected $originalReferenceUuid;

    /**
     * @deprecated use chargebackReferenceUuid
     * @var string
     */
    protected $chargebackReferenceId;

    /**
     * @var string
     */
    protected $chargebackReferenceUuid;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var \DateTime
     */
    protected $reversalDateTime;

    /**
     * @return string
     */
    public function getOriginalUuid()
    {
        return $this->originalUuid;
    }

    /**
     * @param string $originalUuid
     *
     * @return $this
     */
    public function setOriginalUuid($originalUuid)
    {
        $this->originalUuid = $originalUuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalReferenceUuid()
    {
        return $this->originalReferenceUuid;
    }

    /**
     * @param string $originalReferenceUuid
     *
     * @return $this
     */
    public function setOriginalReferenceUuid($originalReferenceUuid)
    {
        $this->originalReferenceUuid = $originalReferenceUuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getChargebackReferenceUuid()
    {
        return $this->chargebackReferenceUuid;
    }

    /**
     * @param string $chargebackReferenceUuid
     *
     * @return $this
     */
    public function setChargebackReferenceUuid($chargebackReferenceUuid)
    {
        $this->chargebackReferenceUuid = $chargebackReferenceUuid;
        return $this;
    }

    /**
     * @deprecated use getOriginalUuid
     * @return string
     */
    public function getOriginalTransactionId() {
        return $this->originalUuid;
    }

    /**
     * @deprecated use setOriginalUuid
     * @param string $originalTransactionId
     */
    public function setOriginalTransactionId($originalTransactionId) {
        $this->originalUuid = $originalTransactionId;
    }

    /**
     * @deprecated use getOriginalReferenceUuid
     * @return string
     */
    public function getOriginalReferenceId() {
        return $this->originalReferenceUuid;
    }

    /**
     * @deprecated use setOriginalReferenceUuid
     * @param string $originalReferenceId
     */
    public function setOriginalReferenceId($originalReferenceId) {
        $this->originalReferenceUuid = $originalReferenceId;
    }

    /**
     * @deprecated use getChargebackReferenceUuid
     * @return string
     */
    public function getChargebackReferenceId() {
        return $this->chargebackReferenceUuid;
    }

    /**
     * @deprecated use setChargebackReferenceUuid
     * @param string $chargebackReferenceId
     */
    public function setChargebackReferenceId($chargebackReferenceId) {
        $this->chargebackReferenceUuid = $chargebackReferenceId;
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
     * @return string
     */
    public function getReason() {
        return $this->reason;
    }

    /**
     * @param string $reason
     */
    public function setReason($reason) {
        $this->reason = $reason;
    }

    /**
     * @return \DateTime
     */
    public function getReversalDateTime() {
        return $this->reversalDateTime;
    }

    /**
     * @param \DateTime $reversalDateTime
     */
    public function setReversalDateTime($reversalDateTime) {
        $this->reversalDateTime = $reversalDateTime;
    }

    /**
	 * @return array
	 */
    public function toArray() {
    	$properties = get_object_vars($this);
    	foreach(array_keys($properties) as $prop) {
    		if (is_object($properties[$prop])) {
    			if (method_exists($properties[$prop], 'toArray')) {
					$properties[$prop] = $properties[$prop]->toArray();
				} else {
					unset($properties[$prop]);
				}
    		}
    	}
		return $properties;
    }

}