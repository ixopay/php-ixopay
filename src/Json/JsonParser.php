<?php

namespace Ixopay\Client\Json;

use Ixopay\Client\Callback\Result as CallbackResult;
use Ixopay\Client\Data\ChargebackData;
use Ixopay\Client\Data\ChargebackReversalData;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\CustomerProfileData;
use Ixopay\Client\Data\Result\CreditcardData as ReturnCardData;
use Ixopay\Client\Data\Result\IbanData as ReturnIbanData;
use Ixopay\Client\Data\Result\PhoneData as ReturnPhoneData;
use Ixopay\Client\Data\Result\ResultData;
use Ixopay\Client\Data\Result\ScheduleResultData;
use Ixopay\Client\Data\Result\WalletData as ReturnWalletData;
use Ixopay\Client\Data\RiskCheckData;
use Ixopay\Client\Exception\ClientException;
use Ixopay\Client\Schedule\ScheduleResult;
use Ixopay\Client\Schedule\ScheduleError;
use Ixopay\Client\StatusApi\StatusResult;
use Ixopay\Client\Transaction\Error;
use Ixopay\Client\Transaction\Result;

/**
 * Class JsonParser
 *
 * @package Ixopay\Client\Json
 */
class JsonParser {

    /** @deprecated */
    public function parseResult($json){}

    /**
     * @param $jsonString
     *
     * @return Result
     * @throws \Exception
     */
    public function parseTransactionResult($jsonString) {

        $json = json_decode($jsonString, true);

        $result = new Result();

        if($json['success'] === true){
            $result->setSuccess(true);
            $result->setReferenceUuid($this->arrGet($json, 'uuid'));
            $result->setPurchaseId($this->arrGet($json, 'purchaseId'));
            $result->setReturnType($this->arrGet($json, 'returnType'));
            $result->setRedirectType($this->arrGet($json, 'redirectType'));
            $result->setRedirectUrl($this->arrGet($json, 'redirectUrl'));
            $result->setHtmlContent($this->arrGet($json, 'htmlContent'));
            $result->setPaymentDescriptor($this->arrGet($json, 'paymentDescriptor'));
            $result->setPaymentMethod($this->arrGet($json, 'paymentMethod'));
            $result->setExtraData($this->arrGet($json, 'extraData'));

            // process object data
            if( isset($json['returnData']) ){
                $returnData = $this->parseReturnData($json['returnData']);
                $result->setReturnData($returnData);
            }

            if( isset($json['scheduleData']) ){
                $scheduleData = $this->parseScheduleData($json['scheduleData']);
                $result->setScheduleData($scheduleData);
            }

            if( isset($json['customerProfileData']) ) {
                $customerProfileData = $this->parseCustomerProfileData($json['customerProfileData']);
                $result->setCustomerProfileData($customerProfileData);
            }

            if ( isset($json['riskCheckData']) ){
                $data = $json['riskCheckData'];
                $riskCheckData = new RiskCheckData();
                $riskCheckData->setRiskCheckResult($this->arrGet($data, 'riskCheckResult'));
                $riskCheckData->setRiskScore($this->arrGet($data, 'riskScore'));
                $riskCheckData->setThreeDSecureRequired($this->arrGet($data, 'threeDSecureRequired'));

                $result->setRiskCheckData($riskCheckData);
            }

            if ( isset($json['errors']) ){
                $errors = $this->parseErrors($json['errors']);
                $result->setErrors($errors);
            }

        } else{

            $result->setSuccess(false);

            $msg = $json['error_message'] ?: '';
            $code = $json['error_code'] ?: '';

            $error = new Error($msg, $code);

            $result->addError($error);
        }

        return $result;

    }

    /**
     * @param string $jsonString
     *
     * @return StatusResult
     * @throws \Exception
     */
    public function parseStatusResult($jsonString) {

        $result = new StatusResult();

        $json = json_decode($jsonString, true);

        $result->setSuccess($this->arrGet($json, 'success'));
        $result->setTransactionStatus($this->arrGet($json, 'transactionStatus'));
        $result->setUuid($this->arrGet($json, 'uuid'));
        $result->setMerchantTransactionId($this->arrGet($json, 'merchantTransactionId'));
        $result->setPurchaseId($this->arrGet($json, 'purchaseId'));
        $result->setTransactionType($this->arrGet($json, 'transactionType'));
        $result->setPaymentMethod($this->arrGet($json, 'paymentMethod'));
        $result->setAmount($this->arrGet($json, 'amount'));
        $result->setCurrency($this->arrGet($json, 'currency'));
        $result->setExtraData($this->arrGet($json, 'extraData'));
        $result->setMerchantMetaData($this->arrGet($json, 'merchantMetaData'));

        // process objects
        if(isset($json['schedules'])) {
            $schedules = [];
            foreach($json['schedules'] as $schedule){
                $schedules[] = $this->parseScheduleData($schedule);
            }

            $result->setSchedules($schedules);
        }

        if(isset($json['errors'])) {
            $errors = $this->parseErrors($json['errors']);
            $result->setErrors($errors);
        }

        if(isset($json['chargebackData'])) {
            $cbData = $this->parseChargebackData($json['chargebackData']);
            $result->setChargebackData($cbData);
        }

        if(isset($json['chargebackReversalData'])) {
            $cbrData = $this->parseChargebackReversalData($json['chargebackReversalData']);
            $result->setChargebackReversalData($cbrData);
        }

        if(isset($json['returnData'])) {
            $returnData = $this->parseReturnData($json['returnData']);
            $result->setReturnData($returnData);
        }

        if(isset($json['customer'])) {
            $customer = $this->parseCustomer($json['customer']);
            $result->setCustomer($customer);
        }

        if(isset($json['customerProfileData'])) {
            $customerProfileData = $this->parseCustomerProfileData($json['customerProfileData']);
            $result->setCustomerProfileData($customerProfileData);
        }

        return $result;
    }

    /**
     * @param $jsonString
     *
     * @return ScheduleResult
     */
    public function parseScheduleResult($jsonString){

        $result = new ScheduleResult();

        $json = json_decode($jsonString, true);

        if( $this->arrGet($json, 'success') ){
            $result->setSuccess($this->arrGet($json, 'success'));
            $result->setScheduleId($this->arrGet($json, 'scheduleId'));
            $result->setRegistrationUuid($this->arrGet($json, 'registrationUuid'));
            $result->setOldStatus($this->arrGet($json, 'oldStatus'));
            $result->setNewStatus($this->arrGet($json, 'newStatus'));
            $result->setScheduledAt($this->arrGet($json, 'scheduledAt'));
            $result->setErrors($this->arrGet($json, 'errors'));
        } else{
            $result->setSuccess(false);

            $errors = [];

            if(isset($json['errors'])){
                foreach($json['errors'] as $e){
                    $err = new ScheduleError(
                        $this->arrGet($e, 'message'),
                        $this->arrGet($e, 'code')
                    );
                    $errors[] = $err;
                }
            }

            $result->setErrors($errors);
        }

        return $result;

    }

    /**
     * @param $jsonString
     *
     * @return array
     * @throws ClientException
     */
    public function parseOptionsResult($jsonString){

        $json = json_decode($jsonString, true);

        if( $this->arrGet($json, 'success') ){
            return $json['options'];
        }

        throw new ClientException($json['error']);

    }

    /**
     * @param $jsonString
     *
     * @return CallbackResult
     * @throws \Exception
     */
    public function parseCallback($jsonString){

        $json = json_decode($jsonString, true);

        $result = new CallbackResult();
        $result->setResult($this->arrGet($json, 'result'));
        $result->setUuid($this->arrGet($json, 'uuid'));
        $result->setMerchantTransactionId($this->arrGet($json, 'merchantTransactionId'));
        $result->setPurchaseId($this->arrGet($json, 'purchaseId'));
        $result->setTransactionType($this->arrGet($json, 'transactionType'));
        $result->setPaymentMethod($this->arrGet($json, 'paymentMethod'));
        $result->setAmount($this->arrGet($json, 'amount'));
        $result->setCurrency($this->arrGet($json, 'currency'));
        $result->setMerchantMetaData($this->arrGet($json, 'merchantMetaData'));
        $result->setExtraData($this->arrGet($json, 'extraData'));

        // process objects
        if(isset($json['scheduleData'])) {
            $schedule = $this->parseScheduleData($json['scheduleData']);
            $result->setScheduleData($schedule);
        }

        if(isset($json['errors'])) {
            $errors = $this->parseErrors($json['errors']);
            $result->setErrors($errors);
        }

        if(isset($json['chargebackData'])) {
            $cbData = $this->parseChargebackData($json['chargebackData']);
            $result->setChargebackData($cbData);
        }

        if(isset($json['chargebackReversalData'])) {
            $cbrData = $this->parseChargebackReversalData($json['chargebackReversalData']);
            $result->setChargebackReversalData($cbrData);
        }

        if(isset($json['returnData'])) {
            $returnData = $this->parseReturnData($json['returnData']);
            $result->setReturnData($returnData);
        }

        if(isset($json['customer'])) {
            $customer = $this->parseCustomer($json['customer']);
            $result->setCustomer($customer);
        }

        if(isset($json['customerProfileData'])) {
            $customerProfileData = $this->parseCustomerProfileData($json['customerProfileData']);
            $result->setCustomerProfileData($customerProfileData);
        }

        return $result;
    }

    /* data parsers */

    /**
     * @param array $returnData
     *
     * @return ResultData|null
     */
    protected function parseReturnData($returnData) {
        $type = array_keys($returnData)[0];
        $data = $returnData[$type];
        $rData = null;

        switch($type){
            case 'returnCardData':
                $creditcardData = new ReturnCardData();
                $creditcardData->setType($this->arrGet($data, 'type'));
                $creditcardData->setFirstName($this->arrGet($data, 'firstName'));
                $creditcardData->setLastName($this->arrGet($data, 'lastName'));
                $creditcardData->setCountry($this->arrGet($data, 'country'));
                $creditcardData->setCardHolder($this->arrGet($data, 'cardHolder'));
                $creditcardData->setExpiryMonth($this->arrGet($data, 'expiryMonth'));
                $creditcardData->setExpiryYear($this->arrGet($data, 'expiryYear'));
                $creditcardData->setFirstSixDigits($this->arrGet($data, 'firstSixDigits'));
                $creditcardData->setLastFourDigits($this->arrGet($data, 'lastFourDigits'));
                $creditcardData->setFingerprint($this->arrGet($data, 'fingerprint'));
                $creditcardData->setBinBrand($this->arrGet($data, 'binBrand'));
                $creditcardData->setBinBank($this->arrGet($data, 'binBank'));
                $creditcardData->setBinType($this->arrGet($data, 'binType'));
                $creditcardData->setBinLevel($this->arrGet($data, 'binLevel'));
                $creditcardData->setBinCountry($this->arrGet($data, 'binCountry'));
                $creditcardData->setThreeDSecure($this->arrGet($data, 'threeDSecure'));
                $creditcardData->setEci($this->arrGet($data, 'eci'));

                return $creditcardData;

            case 'returnPhoneData':
                $phoneData = new ReturnPhoneData();
                $phoneData->setPhoneNumber($this->arrGet($data, 'phoneNumber'));
                $phoneData->setCountry($this->arrGet($data, 'country'));
                $phoneData->setOperator($this->arrGet($data, 'operator'));

                return $phoneData;

            case 'returnIbanData':
                $ibanData = new ReturnIbanData();
                $ibanData->setAccountOwner($this->arrGet($data, 'accountOwner'));
                $ibanData->setIban($this->arrGet($data, 'iban'));
                $ibanData->setBic($this->arrGet($data, 'bic'));
                $ibanData->setBankName($this->arrGet($data, 'bankName'));
                $ibanData->setCountry($this->arrGet($data, 'country'));

                return $ibanData;

            case 'returnWalletData':
                $walletData = new ReturnWalletData();
                $walletData->setWalletOwner($this->arrGet($data, 'walletOwner'));
                $walletData->setWalletReferenceId($this->arrGet($data, 'walletReferenceId'));
                $walletData->setWalletType($this->arrGet($data, 'walletType'));

                return $walletData;

            default:
                return null;
        }
    }

    /**
     * @param $data
     *
     * @return ScheduleResultData
     * @throws \Exception
     */
    protected function parseScheduleData($data){
        $scheduleData = new ScheduleResultData();
        $scheduleData->setScheduleId($this->arrGet($data, 'scheduleId'));
        $scheduleData->setScheduleStatus($this->arrGet($data, 'scheduleStatus'));
        $scheduleData->setScheduledAt($this->arrGet($data, 'scheduledAt') ? new \DateTime($this->arrGet($data, 'scheduledAt')) : null);

        return $scheduleData;
    }

    /**
     * @param $data
     *
     * @return Customer
     */
    protected function parseCustomer($data){
        $customer = new Customer();
        $customer->setIdentification($this->arrGet($data, 'identification'));
        $customer->setFirstName($this->arrGet($data, 'firstName'));
        $customer->setLastName($this->arrGet($data, 'lastName'));
        $customer->setBirthDate($this->arrGet($data, 'birthDate'));
        $customer->setGender($this->arrGet($data, 'gender'));
        $customer->setBillingAddress1($this->arrGet($data, 'billingAddress1'));
        $customer->setBillingAddress2($this->arrGet($data, 'billingAddress2'));
        $customer->setBillingCity($this->arrGet($data, 'billingCity'));
        $customer->setBillingPostcode($this->arrGet($data, 'billingPostcode'));
        $customer->setBillingState($this->arrGet($data, 'billingState'));
        $customer->setBillingCountry($this->arrGet($data, 'billingCountry'));
        $customer->setBillingPhone($this->arrGet($data, 'billingPhone'));
        $customer->setShippingFirstName($this->arrGet($data, 'shippingFirstName'));
        $customer->setShippingLastName($this->arrGet($data, 'shippingLastName'));
        $customer->setShippingCompany($this->arrGet($data, 'shippingCompany'));
        $customer->setShippingAddress1($this->arrGet($data, 'shippingAddress1'));
        $customer->setShippingAddress2($this->arrGet($data, 'shippingAddress2'));
        $customer->setShippingCity($this->arrGet($data, 'shippingCity'));
        $customer->setShippingPostcode($this->arrGet($data, 'shippingPostcode'));
        $customer->setShippingState($this->arrGet($data, 'shippingState'));
        $customer->setShippingCountry($this->arrGet($data, 'shippingCountry'));
        $customer->setShippingPhone($this->arrGet($data, 'shippingPhone'));
        $customer->setCompany($this->arrGet($data, 'company'));
        $customer->setEmail($this->arrGet($data, 'email'));
        $customer->setEmailVerified($this->arrGet($data, 'emailVerified'));
        $customer->setIpAddress($this->arrGet($data, 'ipAddress'));
        $customer->setNationalId($this->arrGet($data, 'nationalId'));

        return $customer;
    }

    /**
     * @param $data
     *
     * @return Error
     */
    protected function parseError($data){
        $error = new Error($this->arrGet($data, 'message'));
        $error->setCode($this->arrGet($data, 'code'));
        $error->setAdapterMessage($this->arrGet($data, 'adapterMessage'));
        $error->setAdapterCode($this->arrGet($data, 'adapterCode'));

        return $error;
    }

    /**
     * @param $data
     *
     * @return array
     */
    protected function parseErrors($data){
        $errors = [];
        foreach($data as $error){
            $errors[] = $this->parseError($error);
        }
        return $errors;
    }

    /**
     * @param $data
     *
     * @return ChargebackData
     */
    protected function parseChargebackData($data){
        $cbData = new ChargebackData();
        $cbData->setOriginalUuid($this->arrGet($data, 'originalUuid'));
        $cbData->setOriginalReferenceUuid($this->arrGet($data, 'originalReferenceUuid'));
        $cbData->setAmount($this->arrGet($data, 'amount'));
        $cbData->setCurrency($this->arrGet($data, 'currency'));
        $cbData->setReason($this->arrGet($data, 'reason'));
        $cbData->setChargebackDateTime($this->arrGet($data, 'chargebackDateTime'));

        return $cbData;
    }

    /**
     * @param $data
     *
     * @return ChargebackReversalData
     */
    protected function parseChargebackReversalData($data){
        $cbrData = new ChargebackReversalData();
        $cbrData->setOriginalUuid($this->arrGet($data, 'originalUuid'));
        $cbrData->setOriginalReferenceUuid($this->arrGet($data, 'originalReferenceUuid'));
        $cbrData->setChargebackReferenceUuid($this->arrGet($data, 'chargebackReferenceUuid'));
        $cbrData->setAmount($this->arrGet($data, 'amount'));
        $cbrData->setCurrency($this->arrGet($data, 'currency'));
        $cbrData->setReason($this->arrGet($data, 'reason'));
        $cbrData->setReversalDateTime($this->arrGet($data, 'reversalDateTime'));

        return $cbrData;
    }

    /**
     * @param $data
     *
     * @return CustomerProfileData
     */
    protected function parseCustomerProfileData($data){
        $customerProfileData = new CustomerProfileData();
        $customerProfileData->setProfileGuid($this->arrGet($data, 'profileGuid'));
        $customerProfileData->setCustomerIdentification($this->arrGet($data, 'customerIdentification'));
        $customerProfileData->setMarkAsPreferred($this->arrGet($data, 'markAsPreferred'));

        return $customerProfileData;
    }
    /**
     * helper function: array get
     * -> returns value at given key if exists
     *
     * @param      $arr
     * @param      $key
     * @param null $default
     *
     * @return null
     */
    protected function arrGet($arr, $key, $default=null){
        if(isset($arr[$key])){
            return $arr[$key];
        }
        return $default;
    }
}