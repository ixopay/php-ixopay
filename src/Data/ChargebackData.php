<?php

namespace Ixopay\Client\Data;

use Ixopay\Client\Transaction\Base\ArrayableInterface;

/**
 * Class ChargebackData
 *
 * @package Ixopay\Client\Data
 */
class ChargebackData implements ArrayableInterface {

    /**
     * @var string
     */
    protected $originalUuid;

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
     * @deprecated use setOriginalMerchantTransactionId()
     *
     * @return string
     */
    public function getOriginalTransactionId() {
        return $this->originalMerchantTransactionId;
    }

    /**
     * @deprecated use setOriginalMerchantTransactionId()
     *
     * @param string $originalTransactionId
     */
    public function setOriginalTransactionId($originalTransactionId) {
        $this->originalMerchantTransactionId = $originalTransactionId;
    }

    /**
     * @deprecated use getOriginalUuid()
     *
     * @return string
     */
    public function getOriginalReferenceId() {
        return $this->originalUuid;
    }

    /**
     * @deprecated use setOriginalUuid()
     *
     * @param string $originalReferenceId
     */
    public function setOriginalReferenceId($originalReferenceId) {
        $this->originalUuid = $originalReferenceId;
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
    			if ($properties[$prop] instanceof ArrayableInterface) {
					$properties[$prop] = $properties[$prop]->toArray();
				} else {
					unset($properties[$prop]);
				}
    		}
    	}
		return $properties;
    }

}
