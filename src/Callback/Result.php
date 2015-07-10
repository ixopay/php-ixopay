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
     * @return int
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
}