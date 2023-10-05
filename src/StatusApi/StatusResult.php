<?php

namespace Ixopay\Client\StatusApi;

use Ixopay\Client\Data\ChargebackData;
use Ixopay\Client\Data\ChargebackReversalData;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\CustomerProfileData;
use Ixopay\Client\Data\Result\ResultData;
use Ixopay\Client\Data\Result\ScheduleResultData;
use Ixopay\Client\Data\TransactionSplit;
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
     * @deprecated use $success
     *
     * @var bool
     */
    protected $operationSuccess;

    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string
     */
    protected $transactionStatus;

    /**
     * @deprecated use $uuid
     *
     * reference id from the payment gateway
     *
     * @var string
     */
    protected $transactionUuid;

    /**
     * @var string
     */
    protected $uuid;

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
     * @var string
     */
    protected $incomingSettlementState;

    /**
     * @var ScheduleResultData[]
     */
    protected $schedules = array();

    /**
     * transaction errors
     *
     * @var Error[]
     */
    protected $errors = array();

    /**
     * @var ChargebackData
     */
    protected $chargebackData = array();

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
     * @var CustomerProfileData
     */
    protected $customerProfileData = null;

    /**
     * request error message
     *
     * @var string
     */
    protected $errorMessage = null;

    /**
     * request error code
     *
     * @var int
     */
    protected $errorCode = null;

    /**
     * @var TransactionSplit[]
     */
    protected $transactionSplits = [];

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     *
     * @return $this
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @deprecated use $isSuccess
     *
     * @return bool
     */
    public function isOperationSuccess() {
        return $this->success;
    }

    /**
     * @deprecated use setSuccess()
     *
     * @param bool $operationSuccess
     *
     * @return $this
     */
    public function setOperationSuccess($operationSuccess) {
        $this->success = $operationSuccess;

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
     * @return $this
     */
    public function setTransactionStatus($transactionStatus) {
        $this->transactionStatus = $transactionStatus;

        return $this;
    }

    /**
     * @deprecated use getUuid
     * @return string
     */
    public function getTransactionUuid() {
        return $this->uuid;
    }

    /**
     * @deprecated use setUuid
     * @param string $transactionUuid
     *
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setMerchantTransactionId($merchantTransactionId) {
        $this->merchantTransactionId = $merchantTransactionId;

        return $this;
    }

    /**
     * @return string
     */
    public function getIncomingSettlementState(){
        return $this->incomingSettlementState;
    }

    /**
     * @param string $incomingSettlementState
     * @return StatusResult
     */
    public function setIncomingSettlementState($incomingSettlementState) {
        $this->incomingSettlementState = $incomingSettlementState;
        return $this;
    }

    /**
     * set transaction errors
     *
     * @param Error[] $errors
     *
     * @return $this
     */
    public function setErrors($errors) {
        $this->errors = $errors;
        return $this;
    }

    /**
     * add transaction error
     *
     * @param Error $error
     *
     * @return $this
     */
    public function addError(Error $error) {
        $this->errors[] = $error;
        return $this;
    }

     /**
     * @return ScheduleResultData[]
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * @param ScheduleResultData[] $schedules
     *
     * @return $this
     */
    public function setSchedules($schedules)
    {
        $this->schedules = $schedules;
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
     * get transaction errors
     *
     * @return Error[]
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * check if transaction has errors
     *
     * @return bool
     */
    public function hasErrors() {
        return !empty($this->errors);
    }

    /**
     * return first transaction error
     *
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
     * @return $this
     */
    public function setCustomer($customer) {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return CustomerProfileData
     */
    public function getCustomerProfileData()
    {
        return $this->customerProfileData;
    }

    /**
     * @param CustomerProfileData $customerProfileData
     *
     * @return StatusResult
     */
    public function setCustomerProfileData($customerProfileData)
    {
        $this->customerProfileData = $customerProfileData;
        return $this;
    }

    /**
     * get request error
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * set request error
     * @param string $errorMessage
     *
     * @return StatusResult
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * get error code
     *
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * set error code
     *
     * @param int $errorCode
     *
     * @return StatusResult
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return TransactionSplit[]
     */
    public function getTransactionSplits()
    {
        return $this->transactionSplits;
    }

    /**
     * @param TransactionSplit[] $transactionSplits
     */
    public function setTransactionSplits($transactionSplits)
    {
        $this->transactionSplits = $transactionSplits;
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
