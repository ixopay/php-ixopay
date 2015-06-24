<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Data\Result\ResultData;

/**
 * Class Result
 * @package Ixopay\Client\Transaction
 */
class Result {

    /**
     * transaction is finished, no further action required
     */
    const RETURN_TYPE_FINISHED = 'FINISHED';
    /**
     * transaction needs a redirect to $redirectUrl
     */
    const RETURN_TYPE_REDIRECT = 'REDIRECT';
    /**
     * transaction needs rendering of $htmlContent
     */
    const RETURN_TYPE_HTML = 'HTML';
    /**
     * transaction is finished, however you MUST verify the result through the corresponding completeXXX method of Client
     */
    const RETURN_TYPE_FINISHED_VERIFY = 'FINISHED_VERIFY';
    /**
     * no result yet, keep polling for status by using completeXXX method
     */
    const RETURN_TYPE_PENDING = 'PENDING';
    /**
     * transaction failed (see $errors)
     */
    const RETURN_TYPE_ERROR = 'ERROR';

    /**
     * @var bool
     */
    protected $success;

    /**
     * reference id from the payment gateway
     * @var string
     */
    protected $referenceId;

    /**
     * id for vault registration (if applicable)
     *
     * @var string
     */
    protected $registrationId;

    /**
     * @var string
     */
    protected $returnType;

    /**
     * @var string
     */
    protected $redirectUrl = null;

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
     * @var ResultData
     */
    protected $returnData = null;

    /**
     * @var Error[]
     */
    protected $errors = array();

    /**
     * @var array
     */
    protected $extraData = array();

    /**
     * data returned in here, must be passed to the completeXXX method
     *
     * @var array
     */
    protected $dataForCompletion = null;


    /**
     * @param bool $success
     * @param int $returnType
     */
    public function __construct($success, $returnType, $referenceId = null) {
        $this->success = $success;
        $this->returnType = $returnType;
        $this->referenceId = $referenceId;
    }

    /**
     * create a result object with an error
     *
     * @param string $errorMessage
     * @param int $errorCode
     * @param string|null $adapterMessage
     * @param string|null $adapterCode
     * @return static
     */
    public static function createWithError($errorMessage, $errorCode=Error::UNKNOWN, $adapterMessage=null, $adapterCode=null) {
        $inst = new static(false, self::RETURN_TYPE_ERROR);
        $error = new Error($errorMessage, $errorCode, $adapterMessage, $adapterCode);
        $inst->addError($error);
        return $inst;
    }

    /**
     * @param null|mixed $referenceId
     * @return static
     */
    public static function createFinished($referenceId=null) {
        return new static(true, self::RETURN_TYPE_FINISHED, $referenceId);
    }

    /**
     * @param string $referenceId
     * @param string $registrationId
     * @return static
     */
    public static function createFinishedWithRegistration($referenceId=null, $registrationId=null) {
        $inst = new static(true, self::RETURN_TYPE_FINISHED, $referenceId);
        $inst->setRegistrationId($registrationId);
        return $inst;
    }

    /**
     * @param null|mixed $referenceId
     * @param null|string $redirectUrl
     * @return static
     */
    public static function createWithRedirect($referenceId = null, $redirectUrl = null) {
        $inst = new static(true, self::RETURN_TYPE_REDIRECT, $referenceId);
        $inst->setRedirectUrl($redirectUrl);
        return $inst;
    }

    /**
     * @param null|mixed $referenceId
     * @param string $htmlContent
     * @return static
     */
    public static function createWithHtml($referenceId=null, $htmlContent = "") {
        $inst = new static(true, self::RETURN_TYPE_HTML, $referenceId);
        $inst->setHtmlContent($htmlContent);
        return $inst;
    }

    /**
     * @param null|mixed $referenceId
     * @return static
     */
    public static function createWithVerify($referenceId=null) {
        return new static(true, self::RETURN_TYPE_FINISHED_VERIFY, $referenceId);
    }

    /**
     * @param null|mixed $referenceId
     * @return static
     */
    public static function createWithPending($referenceId=null) {
        return new static(true, self::RETURN_TYPE_PENDING, $referenceId);
    }

    /**
     * @param string $referenceId
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    }


    /**
     * @param string $redirectUrl
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @param string $htmlContent
     */
    public function setHtmlContent($htmlContent)
    {
        $this->htmlContent = $htmlContent;
    }

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
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @return string
     */
    public function getHtmlContent()
    {
        return $this->htmlContent;
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
     * @return int
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * @param int $returnType
     */
    public function setReturnType($returnType)
    {
        $this->returnType = $returnType;
    }

    /**
     * @return string
     */
    public function getRegistrationId()
    {
        return $this->registrationId;
    }

    /**
     * @param string $registrationId
     */
    public function setRegistrationId($registrationId)
    {
        $this->registrationId = $registrationId;
    }

    /**
     * @return string
     */
    public function getPaymentDescriptor() {
        return $this->paymentDescriptor;
    }

    /**
     * @param string $paymentDescriptor
     */
    public function setPaymentDescriptor($paymentDescriptor) {
        $this->paymentDescriptor = $paymentDescriptor;
    }

    /**
     * @return array
     */
    public function getDataForCompletion() {
        return $this->dataForCompletion;
    }

    /**
     * @param array $dataForCompletion
     */
    public function setDataForCompletion($dataForCompletion) {
        $this->dataForCompletion = $dataForCompletion;
    }

    /**
     * @return \IxopayV2\Data\Result\ResultData
     */
    public function getReturnData()
    {
        return $this->returnData;
    }

    /**
     * @param \IxopayV2\Data\Result\ResultData $returnData
     */
    public function setReturnData($returnData)
    {
        $this->returnData = $returnData;
    }


}