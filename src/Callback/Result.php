<?php

namespace Ixopay\Client\Callback;

use Ixopay\Client\Transaction\Error;

/**
 * Class Result
 *
 * @package Ixopay\Client\Callback
 */
class Result {

    const RESULT_OK = 'OK';
    const RESULT_PENDING = 'PENDING';
    const RESULT_ERROR = 'ERROR';
    const RESULT_INVALID_REQUEST = 'INVALID_REQUEST';

    /**
     * @var string
     */
    protected $result;

    /**
     * reference id from the payment gateway
     * @var string
     */
    protected $referenceId;

    /**
     * your transaction id from the initial transaction (if returned by adapter)
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
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @param Error $error
     */
    public function addError(Error $error) {
        $this->errors[] = $error;
    }

    /**
     * @param array $extraData
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function addExtraData($key, $value) {
        $this->extraData[$key] = $value;
        return $this;
    }


    /**
     * @return Error[]
     */
    public function getErrors()
    {
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
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * @param string $result
     */
    public function setResult($result) {
        $this->result = $result;
    }

    /**
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @param string $referenceId
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }
}