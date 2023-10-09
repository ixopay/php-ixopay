<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\CustomerProfileData;
use Ixopay\Client\Data\Result\ResultData;
use Ixopay\Client\Data\Result\ScheduleResultData;
use Ixopay\Client\Data\RiskCheckData;

/**
 * Class Result
 *
 * @package Ixopay\Client\Transaction
 */
class Result {

    /** transaction is finished, no further action required */
    const RETURN_TYPE_FINISHED = 'FINISHED';
    /** transaction needs a redirect to $redirectUrl */
    const RETURN_TYPE_REDIRECT = 'REDIRECT';
    /** transaction needs rendering of $htmlContent */
    const RETURN_TYPE_HTML = 'HTML';
    /** no result yet, wait for callback notification */
    const RETURN_TYPE_PENDING = 'PENDING';
    /** transaction failed (see $errors) */
    const RETURN_TYPE_ERROR = 'ERROR';

    const REDIRECT_TYPE_IFRAME = 'iframe';
    const REDIRECT_TYPE_FULLPAGE = 'fullpage';

    const SCHEDULE_STATUS_ACTIVE = 'ACTIVE';
    const SCHEDULE_STATUS_PAUSED = 'PAUSED';
    const SCHEDULE_STATUS_CANCELLED = 'CANCELLED';
    const SCHEDULE_STATUS_ERROR = 'ERROR';
    const SCHEDULE_STATUS_CREATE_PENDING = 'CREATE-PENDING'; // create process of a schedule not yet finished

    /**
     * @var bool
     */
    protected $success;

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
     * @var string
     */
    protected $uuid;

    /**
     * purchase id from gateway (can be used for any subsequent action on this transaction)
     *
     * @var string
     */
    protected $purchaseId;

    /**
     * @deprecated not in use anymore
     *
     * id for vault registration (if applicable)
     *
     * @var string
     */
    protected $registrationId;

    /**
     * one of the RETURN_TYPE_* constants, defines how to proceed with the transaction
     *
     * @var string
     */
    protected $returnType;

    /**
     * if returnType = REDIRECT, this property informs if you should do a whole page redirect ("fullpage") or within an iframe ("iframe")
     *
     * @var string
     */
    protected $redirectType = null;

    /**
     * @var string
     */
    protected $redirectUrl = null;

    /**
     * @var string
     */
    protected $redirectQRCode = null;

    /**
     * @var string
     */
    protected $htmlContent = null;

    /**
     * the descriptor which appears on the customer's credit note/transaction history etc.
     *
     * @var string
     */
    protected $paymentDescriptor = null;

    /**
     * identifier of the payment method for this transaction
     *
     * @var string|null
     */
    protected $paymentMethod = null;

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
     * @var RiskCheckData
     */
    protected $riskCheckData = null;

    /**
     * @var ScheduleResultData
     */
    protected $scheduleData = null;

    /**
     * @var Error[]
     */
    protected $errors = array();

    /**
     * @var array
     */
    protected $extraData = array();

    /**
     * Result constructor.
     */
    public function __construct(){
        $this->customer = new Customer();
        $this->customerProfileData = new CustomerProfileData();
        $this->riskCheckData = new RiskCheckData();
        $this->scheduleData = new ScheduleResultData();
    }

    /**
     * @deprecated use setUuid()
     *
     * @param string $referenceId
     * @return $this
     */
    public function setReferenceId($referenceId) {
        $this->setUuid($referenceId);
        return $this;
    }

    /**
     * @param $uuid
     *
     * @return $this
     */
    public function setUuid($uuid) {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @param string $redirectUrl
     *
     * @return $this
     */
    public function setRedirectUrl($redirectUrl) {
        $this->redirectUrl = $redirectUrl;
        return $this;
    }

    /**
     * @param string $redirectQRCode
     *
     * @return $this
     */
    public function setRedirectQRCode($redirectQRCode) {
        $this->redirectQRCode = $redirectQRCode;
        return $this;
    }

    /**
     * @param string $htmlContent
     *
     * @return $this
     */
    public function setHtmlContent($htmlContent) {
        $this->htmlContent = $htmlContent;
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
     * @param boolean $success
     *
     * @return $this
     */
    public function setSuccess($success) {
        $this->success = $success;
        return $this;
    }

    /**
     * returns whether the transaction was successful or not
     *
     * @return boolean
     */
    public function isSuccess() {
        return $this->success;
    }

    /**
     * @deprecated use getUuid()
     *
     * contains IxoPay's transaction id
     *
     * @return string
     */
    public function getReferenceId() {
        return $this->getUuid();
    }

    /**
     * @return string
     */
    public function getUuid() {
        return $this->uuid;
    }

    /**
     * contains the redirect url if returnType = 'REDIRECT'
     *
     * @return string
     */
    public function getRedirectUrl() {
        return $this->redirectUrl;
    }

    /**
     * contains the QR Code (base64) with the redirect url if returnType = 'REDIRECT'
     *
     * @return string
     */
    public function getRedirectQRCode() {
        return $this->redirectQRCode;
    }

    /**
     * contains the html content to render if returnType = 'HTML'
     *
     * @return string
     */
    public function getHtmlContent() {
        return $this->htmlContent;
    }

    /**
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
     * tells you how to proceed with the transaction
     *
     * @return int
     */
    public function getReturnType() {
        return $this->returnType;
    }

    /**
     * @param int $returnType
     *
     * @return $this
     */
    public function setReturnType($returnType) {
        $this->returnType = $returnType;
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectType() {
        return $this->redirectType;
    }

    /**
     * @param string $redirectType
     */
    public function setRedirectType($redirectType) {
        $this->redirectType = $redirectType;
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
     * contains the registrationId if transaction was a register, or a debit/preauthorize with register
     *
     * @return string
     */
    public function getRegistrationId() {
        return $this->registrationId;
    }

    /**
     * @param string $registrationId
     *
     * @return $this
     */
    public function setRegistrationId($registrationId) {
        $this->registrationId = $registrationId;
        return $this;
    }

    /**
     * contains the descriptor shown on the customer's account statement (if any)
     *
     * @return string
     */
    public function getPaymentDescriptor() {
        return $this->paymentDescriptor;
    }

    /**
     * @param string $paymentDescriptor
     *
     * @return $this
     */
    public function setPaymentDescriptor($paymentDescriptor) {
        $this->paymentDescriptor = $paymentDescriptor;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    /**
     * @param null|string $paymentMethod
     * @return Result
     */
    public function setPaymentMethod($paymentMethod) {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }


    /**
     * contains additional data for your purpose (e.g. credit card information)
     *
     * @return \Ixopay\Client\Data\Result\ResultData
     */
    public function getReturnData() {
        return $this->returnData;
    }

    /**
     * @param \Ixopay\Client\Data\Result\ResultData $returnData
     *
     * @return $this
     */
    public function setReturnData($returnData) {
        $this->returnData = $returnData;
        return $this;
    }

    /**
     * @return ScheduleResultData
     */
    public function getScheduleData()
    {
        return $this->scheduleData;
    }

    /**
     * @param ScheduleResultData $scheduleData
     *
     * @return Result
     */
    public function setScheduleData($scheduleData)
    {
        $this->scheduleData = $scheduleData;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheduleId() {
        return $this->scheduleData ? $this->scheduleData->getScheduleId() : null;
    }

    /**
     * @param string $scheduleId
     *
     * @return Result
     */
    public function setScheduleId($scheduleId) {
        $this->scheduleData->setScheduleId($scheduleId);

        return $this;
    }

    /**
     * @return string
     */
    public function getScheduleStatus() {
        return $this->scheduleData ? $this->scheduleData->getScheduleStatus() : null;
    }

    /**
     * @param string $scheduleStatus
     *
     * @return Result
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
     * @return Result
     */
    public function setCustomerProfileData($customerProfileData)
    {
        $this->customerProfileData = $customerProfileData;
        return $this;
    }

    /**
     * @return RiskCheckData
     */
    public function getRiskCheckData()
    {
        return $this->riskCheckData;
    }

    /**
     * @param RiskCheckData $riskCheckData
     *
     * @return Result
     */
    public function setRiskCheckData($riskCheckData)
    {
        $this->riskCheckData = $riskCheckData;
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

    /**
     * Note: returns string due to backwards compatibility
     * use direct access to $this->getScheduleData()->getScheduledAt() for \DateTime type
     * @return string
     */
    public function getScheduledAt() {
        return $this->getScheduleData() && $this->getScheduleData()->getScheduledAt()
            ? $this->getScheduleData()->getScheduledAt()->format('Y-m-d H:i:s')
            : null;
    }

    /**
     * @param string|\DateTime|null $scheduledAt
     *
     * @return Result
     */
    public function setScheduledAt($scheduledAt) {

        if ($scheduledAt instanceof \DateTime) {
            $scheduledAt = $scheduledAt->format('Y-m-d H:i:s T');
        }

        $this->scheduleData->setScheduledAt($scheduledAt);

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
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

}
