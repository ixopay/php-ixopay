<?php

namespace Ixopay\Client\Callback;

use Ixopay\Client\Data\ChargebackData;
use Ixopay\Client\Data\ChargebackReversalData;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\CustomerProfileData;
use Ixopay\Client\Data\Result\ResultData;
use Ixopay\Client\Data\Result\ScheduleResultData;
use Ixopay\Client\Data\TracingData\TracingData;
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
    const TYPE_CHARGEBACK_REVERSAL = 'CHARGEBACK-REVERSAL';
    const TYPE_PAYOUT = 'PAYOUT';

    /**
     * @var string
     */
    protected $result;

    /**
     * @deprecated use $uuid
     *
     * reference id from the payment gateway
     *
     * @var string
     */
    protected $referenceId;

    /**
     * reference id from the payment gateway
     *
     * @var string
     */
    protected $uuid;

    /**
     * @deprecated use $merchantTransactionId
     *
     * your transaction id from the initial transaction (if returned by adapter)
     *
     * @var string
     */
    protected $transactionId;

    /**
     * your transaction id from the initial transaction (if returned by adapter)
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
    protected $transactionSubType;

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
     * @deprecated use $scheduleData
     *
     * @var string
     */
    protected $scheduleId;

    /**
     * @deprecated use $scheduleData
     *
     * @var string
     */
    protected $scheduleStatus;

    /**
     * @var ScheduleResultData
     */
    protected $scheduleData;

    /**
     * @var CustomerProfileData
     */
    protected $customerProfileData;

    /**
     * @var string
     */
    protected $errorMessage = null;

    /**
     * @var int
     */
    protected $errorCode = null;

    /**
     * @var string
     */
    protected $adapterMessage = null;

    /**
     * @var int
     */
    protected $adapterCode = null;

    /**
     * @var string
     */
    protected $scheduleMerchantMetaData;

    /**
     * @deprecated use $errorMessage, $errorCode, $adapterMessage, $adapterCode
     *
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
     * @var null|TracingData
     */
    protected $tracingData = null;

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
     *
     * @return $this
     */
    public function setMerchantMetaData($merchantMetaData)
    {
        $this->merchantMetaData = $merchantMetaData;
        return $this;
    }

    /**
     * @deprecated use getErrorMessage(), getErrorCode(), getAdapterMessage(), getAdapterCode()
     *
     * @return Error[]
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @deprecated
     *
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
     * @deprecated use getUuid()
     *
     * @return string
     */
    public function getReferenceId() {
        return $this->uuid;
    }

    /**
     * @deprecated use setUuid()
     *
     * @param string $referenceId
     *
     * @return $this
     */
    public function setReferenceId($referenceId) {
        $this->uuid = $referenceId;
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
     * @deprecated use getMerchantTransactionId()
     *
     * @return string
     */
    public function getTransactionId() {
        return $this->merchantTransactionId;
    }

    /**
     * @deprecated use setMerchantTransactionId()
     *
     * @param string $transactionId
     *
     * @return $this
     */
    public function setTransactionId($transactionId) {
        $this->merchantTransactionId = $transactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantTransactionId()
    {
        return $this->merchantTransactionId;
    }

    /**
     * @param string $merchantTransactionId
     *
     * @return $this
     */
    public function setMerchantTransactionId($merchantTransactionId)
    {
        $this->merchantTransactionId = $merchantTransactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurchaseId() {
        return $this->purchaseId;
    }

    /**
     * @param string $purchaseId
     *
     * @return $this
     */
    public function setPurchaseId($purchaseId) {
        $this->purchaseId = $purchaseId;
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
     *
     * @return $this
     */
    public function setTransactionType($transactionType) {
        $this->transactionType = $transactionType;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionSubType()
    {
        return $this->transactionSubType;
    }

    /**
     * @param string $transactionSubType
 *
     * @return $this
     */
    public function setTransactionSubType($transactionSubType)
    {
        $this->transactionSubType = $transactionSubType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     *
     * @return $this
     */
    public function setPaymentMethod($paymentMethod) {
        $this->paymentMethod = $paymentMethod;
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
     * @return ScheduleResultData
     */
    public function getScheduleData() {
        return $this->scheduleData;
    }

    /**
     * @param ScheduleResultData $scheduleData
     *
     * @return $this
     */
    public function setScheduleData($scheduleData) {
        $this->scheduleData = $scheduleData;
        return $this;
    }

    /**
     * @deprecated use getScheduleData()
     *
     * @return string
     */
    public function getScheduleId() {
        return $this->scheduleData->getScheduleId();
    }

    /**
     * @deprecated use setScheduleData()
     *
     * @param string $scheduleId
     * @return $this
     */
    public function setScheduleId($scheduleId) {
        $this->scheduleData->setScheduleId($scheduleId);
        return $this;
    }

    /**
     * @deprecated use getScheduleData()
     *
     * @return string
     */
    public function getScheduleStatus() {
        return $this->scheduleData->getScheduleStatus();
    }

    /**
     * @deprecated use setScheduleData()
     *
     * @param string $scheduleStatus
     * @return $this
     */
    public function setScheduleStatus($scheduleStatus) {
        $this->scheduleData->setScheduleStatus($scheduleStatus);
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
     * @return $this
     */
    public function setCustomerProfileData($customerProfileData)
    {
        $this->customerProfileData = $customerProfileData;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheduleMerchantMetaData() {
        return $this->scheduleMerchantMetaData;
    }

    /**
     * @param string $scheduleMerchantMetaData
     * @return Result
     */
    public function setScheduleMerchantMetaData($scheduleMerchantMetaData) {
        $this->scheduleMerchantMetaData = $scheduleMerchantMetaData;
        return $this;
    }

    /**
     * @return ChargebackData
     */
    public function getChargebackData() {
        return $this->chargebackData;
    }

    /**
     * @param ChargebackData $chargebackData
     *
     * @return $this
     */
    public function setChargebackData(ChargebackData $chargebackData) {
        $this->chargebackData = $chargebackData;
        return $this;
    }

    /**
     * @return ChargebackReversalData
     */
    public function getChargebackReversalData() {
        return $this->chargebackReversalData;
    }

    /**
     * @param ChargebackReversalData $chargebackReversalData
     *
     * @return $this
     */
    public function setChargebackReversalData($chargebackReversalData) {
        $this->chargebackReversalData = $chargebackReversalData;
        return $this;
    }

    /**
     * @return ResultData
     */
    public function getReturnData() {
        return $this->returnData;
    }

    /**
     * @param ResultData $returnData
     *
     * @return $this
     */
    public function setReturnData($returnData) {
        $this->returnData = $returnData;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
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
     * @return null|TracingData
     */
    public function getTracingData()
    {
        return $this->tracingData;
    }

    /**
     * @param null|TracingData $tracingData
     *
     * @return $this
     */
    public function setTracingData($tracingData) {
        $this->tracingData = $tracingData;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     *
     * @return Result
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     *
     * @return Result
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdapterMessage()
    {
        return $this->adapterMessage;
    }

    /**
     * @param string $adapterMessage
     *
     * @return Result
     */
    public function setAdapterMessage($adapterMessage)
    {
        $this->adapterMessage = $adapterMessage;
        return $this;
    }

    /**
     * @return int
     */
    public function getAdapterCode()
    {
        return $this->adapterCode;
    }

    /**
     * @param int $adapterCode
     *
     * @return Result
     */
    public function setAdapterCode($adapterCode)
    {
        $this->adapterCode = $adapterCode;
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
