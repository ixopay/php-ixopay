<?php

namespace Ixopay\Client\StatusApi;

use Ixopay\Client\Callback\ChargebackData;
use Ixopay\Client\Callback\ChargebackReversalData;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\Result\ResultData;
use Ixopay\Client\Transaction\Error;

/**
 *
 * @package Ixopay\Client\StatusApi
 */
class StatusResult {

    const TRANSACTION_SUCCESS = 'SUCCESS';
    const TRANSACTION_PENDING = 'PENDING';
    const TRANSACTION_REDIRECT = 'REDIRECT';
    const TRANSACTION_CANCELLED = 'CANCELLED';
    const TRANSACTION_ERROR = 'ERROR';

    const TYPE_DEBIT = 'DEBIT';
    const TYPE_CAPTURE = 'CAPTURE';
    const TYPE_DEREGISTER = 'DEREGISTER';
    const TYPE_PREAUTHORIZE = 'PREAUTHORIZE';
    const TYPE_REFUND = 'REFUND';
    const TYPE_REGISTER = 'REGISTER';
    const TYPE_VOID = 'VOID';
    const TYPE_CHARGEBACK = 'CHARGEBACK';
    const TYPE_CHARGEBACK_REVERSAL = 'CHARGEBACK-REVERSAL';
    const TYPE_PAYOUT = 'PAYOUT';

    /**
     * @var bool
     */
    protected $operationSuccess;

    /**
     * @var string
     */
    protected $transactionStatus;

    /**
     * reference id from the payment gateway
     *
     * @var string
     */
    protected $transactionUuid;

    /**
     * your transaction id from the initial transaction (if returned by adapter)
     *
     * @var string
     */
    protected $merchantTransactionId;

    /**
     * purchase id from gateway (can be used for any subsequent action on this transaction)
     *
     * @var string
     */
    protected $purchaseId;

    /**
     * type of the transaction (e.g. DEBIT, CAPTURE etc.)
     *
     * @var string
     */
    protected $transactionType;

    /**
     * @var string
     */
    protected $paymentMethod;

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
     * @var string
     */
    protected $merchantMetaData;

    /**
     * chargeback data (if transactionType = CHARGEBACK)
     *
     * @var ChargebackData
     */
    protected $chargebackData = null;

    /**
     * Chargeback reversal data (if transactionType = CHARGEBACK-REVERSAL)
     *
     * @var ChargebackReversalData
     */
    protected $chargebackReversalData = null;

    /**
     * @var ResultData
     */
    protected $returnData = null;

    /**
     * @var Customer
     */
    protected $customer = null;

    /**
     * @return bool
     */
    public function isOperationSuccess() {
        return $this->operationSuccess;
    }

    /**
     * @param bool $operationSuccess
     *
     * @return StatusResult
     */
    public function setOperationSuccess($operationSuccess) {
        $this->operationSuccess = $operationSuccess;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionStatus() {
        return $this->transactionStatus;
    }

    /**
     * @param string $transactionStatus
     *
     * @return StatusResult
     */
    public function setTransactionStatus($transactionStatus) {
        $this->transactionStatus = $transactionStatus;

        return $this;
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
     * @return StatusResult
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
     * @return StatusResult
     */
    public function setMerchantTransactionId($merchantTransactionId) {
        $this->merchantTransactionId = $merchantTransactionId;

        return $this;
    }

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
     * @return string
     */
    public function getMerchantMetaData()
    {
        return $this->merchantMetaData;
    }

    /**
     * @param string $merchantMetaData
     * @return $this
     */
    public function setMerchantMetaData($merchantMetaData)
    {
        $this->merchantMetaData = $merchantMetaData;
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
     * @return string
     */
    public function getPurchaseId() {
        return $this->purchaseId;
    }

    /**
     * @param string $purchaseId
     */
    public function setPurchaseId($purchaseId) {
        $this->purchaseId = $purchaseId;
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
     * @return string
     */
    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod($paymentMethod) {
        $this->paymentMethod = $paymentMethod;
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

    /**
     * @return ChargebackReversalData
     */
    public function getChargebackReversalData() {
        return $this->chargebackReversalData;
    }

    /**
     * @param ChargebackReversalData $chargebackReversalData
     */
    public function setChargebackReversalData($chargebackReversalData) {
        $this->chargebackReversalData = $chargebackReversalData;
    }

    /**
     * @return ResultData
     */
    public function getReturnData() {
        return $this->returnData;
    }

    /**
     * @param ResultData $returnData
     */
    public function setReturnData($returnData) {
        $this->returnData = $returnData;
    }

    /**
     * @return Customer
     */
    public function getCustomer() {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     *
     * @return StatusResult
     */
    public function setCustomer($customer) {
        $this->customer = $customer;

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
