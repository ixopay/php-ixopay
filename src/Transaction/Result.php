<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Data\Result\ResultData;

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
    /** no result yet, keep polling for status by using completeXXX method */
    const RETURN_TYPE_PENDING = 'PENDING';
    /** transaction failed (see $errors) */
    const RETURN_TYPE_ERROR = 'ERROR';

    /**
     * @var bool
     */
    protected $success;

    /**
     * reference id from the payment gateway
     *
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
     * @param string $referenceId
     *
     * @return $this
     */
    public function setReferenceId($referenceId) {
        $this->referenceId = $referenceId;
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
     * contains IxoPay's transaction id
     *
     * @return string
     */
    public function getReferenceId() {
        return $this->referenceId;
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