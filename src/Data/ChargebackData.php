<?php

namespace Ixopay\Client\Data;

/**
 * Class ChargebackData
 *
 * @package Ixopay\Client\Data
 */
class ChargebackData {

    /**
     * @deprecated use $originalUuid
     *
     * @var string
     */
    protected $originalTransactionId;

    /**
     * @var string
     */
    protected $originalUuid;

    /**
     * @deprecated use $originalMerchantTransactionId
     *
     * @var string
     */
    protected $originalReferenceId;

    /**
     * @var string
     */
    protected $originalMerchantTransactionId;

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
    protected $chargebackDateTime;

    /**
     * @deprecated use getOriginalUuid()
     *
     * @return string
     */
    public function getOriginalTransactionId() {
        return $this->originalUuid;
    }

    /**
     * @deprecated use setOriginalUuid()
     *
     * @param string $originalTransactionId
     */
    public function setOriginalTransactionId($originalTransactionId) {
        $this->originalUuid = $originalTransactionId;
    }

    /**
     * @deprecated use getOriginalMerchantTransactionId()
     *
     * @return string
     */
    public function getOriginalReferenceId() {
        return $this->originalMerchantTransactionId;
    }

    /**
     * @deprecated use setOriginalMerchantTransactionId()
     *
     * @param string $originalReferenceId
     */
    public function setOriginalReferenceId($originalReferenceId) {
        $this->originalMerchantTransactionId = $originalReferenceId;
    }

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
    public function getOriginalMerchantTransactionId()
    {
        return $this->originalMerchantTransactionId;
    }

    /**
     * @param string $originalMerchantTransactionId
     *
     * @return $this
     */
    public function setOriginalMerchantTransactionId($originalMerchantTransactionId)
    {
        $this->originalMerchantTransactionId = $originalMerchantTransactionId;
        return $this;
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
    public function getChargebackDateTime() {
        return $this->chargebackDateTime;
    }

    /**
     * @param \DateTime|string $chargebackDateTime
     *
     * @return $this
     * @throws \Exception
     */
    public function setChargebackDateTime($chargebackDateTime) {
        if (!empty($chargebackDateTime) && is_string($chargebackDateTime)) {
            $chargebackDateTime = new \DateTime($chargebackDateTime);
        }
        $this->chargebackDateTime = $chargebackDateTime;
        return $this;
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