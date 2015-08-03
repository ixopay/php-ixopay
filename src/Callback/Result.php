<?php

namespace Ixopay\Client\Callback;

use Ixopay\Client\Transaction\Error;

/**
 * Callback result, which is produced by processing a callback request's body.
 * Reports the status of an asynchronous transaction.
 *
 * @package Ixopay\Client\Callback
 */
class Result {
    /** The callback reports, that the transaction finished successfully. */
    const RESULT_OK = 'OK';
    /** The callback reports that the transaction is pending (an update call is expected, or the status should be pulled) */
    const RESULT_PENDING = 'PENDING';
    /** The transaction failed, please refer to the errors. */
    const RESULT_ERROR = 'ERROR';
    /** The callback request is invalid. */
    const RESULT_INVALID_REQUEST = 'INVALID_REQUEST';

    const TYPE_DEBIT = 'DEBIT';
    const TYPE_CAPTURE = 'CAPTURE';
    const TYPE_DEREGISTER = 'DEREGISTER';
    const TYPE_PREAUTHORIZE = 'PREAUTHORIZE';
    const TYPE_REFUND = 'REFUND';
    const TYPE_REGISTER = 'REGISTER';
    const TYPE_VOID = 'VOID';
    const TYPE_CHARGEBACK = 'CHARGEBACK';

    /**
     * @var string
     */
    protected $result;

    /**
     * reference id from the payment gateway
     *
     * @var string
     */
    protected $referenceId;

    /**
     * your transaction id from the initial transaction (if returned by adapter)
     *
     * @var string
     */
    protected $transactionId;

    /**
     * type of the transaction (e.g. DEBIT, CAPTURE etc.)
     *
     * @var string
     */
    protected $transactionType;

    /**
     * @var double
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var Error[]
     */
    protected $errors = array();

    /**
     * for your internal use
     *
     * @var array
     */
    protected $extraData = array();

    /**
     * chargeback data (if transactionType = CHARGEBACK)
     *
     * @var ChargebackData
     */
    protected $chargebackData = null;


    /**
     * @param Error[] $errors
     *
     * @return $this
     */
    public function setErrors($errors) {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @param Error $error
     *
     * @return $this
     */
    public function addError(Error $error) {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * @param array $extraData
     *
     * @return $this
     */
    public function setExtraData($extraData) {
        $this->extraData = $extraData;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function addExtraData($key, $value) {
        $this->extraData[$key] = $value;
        return $this;
    }

    /**
     * @return Error[]
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors() {
        return !empty($this->errors);
    }

    /**
     * @return Error|null
     */
    public function getFirstError() {
        if (!empty($this->errors)) {
            return $this->errors[0];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getExtraData() {
        return $this->extraData;
    }

    /**
     * @param string $result
     *
     * @return $this
     */
    public function setResult($result) {
        $this->result = $result;
        return $this;
    }

    /**
     * Returns the result code of the event (one of the Result::RESULT_* constants).
     *
     * @return string
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getReferenceId() {
        return $this->referenceId;
    }

    /**
     * @param string $referenceId
     *
     * @return $this
     */
    public function setReferenceId($referenceId) {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId() {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     *
     * @return $this
     */
    public function setTransactionId($transactionId) {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionType() {
        return $this->transactionType;
    }

    /**
     * @param string $transactionType
     */
    public function setTransactionType($transactionType) {
        $this->transactionType = $transactionType;
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
     * @return ChargebackData
     */
    public function getChargebackData() {
        return $this->chargebackData;
    }

    /**
     * @param ChargebackData $chargebackData
     */
    public function setChargebackData(ChargebackData $chargebackData) {
        $this->chargebackData = $chargebackData;
    }

}