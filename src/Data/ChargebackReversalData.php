<?php

namespace Ixopay\Client\Data;

/**
 * Class ChargebackReversalData
 *
 * @package Ixopay\Client\Data
 */
class ChargebackReversalData {

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
     * @deprecated use $chargebackUuid
     *
     * @var string
     */
    protected $chargebackReferenceId;

    /**
     * @var string
     */
    protected $chargebackUuid;

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
     * @return string
     */
    public function getChargebackUuid()
    {
        return $this->chargebackUuid;
    }

    /**
     * @param string $chargebackUuid
     *
     * @return $this
     */
    public function setChargebackUuid($chargebackUuid)
    {
        $this->chargebackUuid = $chargebackUuid;
        return $this;
    }

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
     * @deprecated use getChargebackUuid()
     *
     * @return string
     */
    public function getChargebackReferenceId() {
        return $this->chargebackUuid;
    }

    /**
     * @deprecated use setChargebackUuid()
     * @param string $chargebackReferenceId
     */
    public function setChargebackReferenceId($chargebackReferenceId) {
        $this->chargebackUuid = $chargebackReferenceId;
    }

    /**
     * @return float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return $this
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getReason() {
        return $this->reason;
    }

    /**
     * @param string $reason
     *
     * @return $this
     */
    public function setReason($reason) {
        $this->reason = $reason;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReversalDateTime() {
        return $this->reversalDateTime;
    }

    /**
     * @param \DateTime|string $reversalDateTime
     *
     * @return $this
     * @throws \Exception
     */
    public function setReversalDateTime($reversalDateTime) {
        if (!empty($reversalDateTime) && is_string($reversalDateTime)) {
            $reversalDateTime = new \DateTime($reversalDateTime);
        }
        $this->reversalDateTime = $reversalDateTime;
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