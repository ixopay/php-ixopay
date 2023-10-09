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
use Ixopay\Client\Data\TransactionSplit;
use Ixopay\Client\Options\OptionsResult;
use Ixopay\Client\Schedule\ScheduleResult;
use Ixopay\Client\StatusApi\StatusResult;
use Ixopay\Client\Transaction\Error;
use Ixopay\Client\Transaction\Result;

/**
 * Class JsonParser
 *
 * @package Ixopay\Client\Json
 */
class JsonParser {

    /** @deprecated
     * @param string $json
     */
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

        if(!$result->isSuccess() && isset($json['errorMessage'])){
            // handle general errors
            $result->setSuccess(false);
            $error = new Error();
            $error->setMessage($this->arrGet($json, 'errorMessage'));
            $error->setCode($this->arrGet($json, 'errorCode'));
            $result->addError($error);
            return $result;
        }

        $result->setSuccess($json['success']);
        $result->setUuid($this->arrGet($json, 'uuid'));
        $result->setPurchaseId($this->arrGet($json, 'purchaseId'));
        $result->setReturnType($this->arrGet($json, 'returnType'));
        $result->setRedirectType($this->arrGet($json, 'redirectType'));
        $result->setRedirectUrl($this->arrGet($json, 'redirectUrl'));
        $result->setRedirectQRCode($this->arrGet($json, 'redirectQRCode'));
        $result->setHtmlContent($this->arrGet($json, 'htmlContent'));
        $result->setPaymentDescriptor($this->arrGet($json, 'paymentDescriptor'));
        $result->setPaymentMethod($this->arrGet($json, 'paymentMethod'));
        $result->setExtraData($this->arrGet($json, 'extraData'));

        // process object data
        if (isset($json['errors'])){
            $errors = $this->parseErrors($json['errors']);
            $result->setErrors($errors);
        }
        if (isset($json['returnData'])) {
            $returnData = $this->parseReturnData($json['returnData']);
            $result->setReturnData($returnData);
        }

        if (isset($json['scheduleData'])) {
            $scheduleData = $this->parseScheduleData($json['scheduleData']);
            $result->setScheduleData($scheduleData);
        }

        if (isset($json['customerProfileData'])) {
            $customerProfileData = $this->parseCustomerProfileData($json['customerProfileData']);
            $result->setCustomerProfileData($customerProfileData);
        }

        if (isset($json['riskCheckData'])) {
            $data = $json['riskCheckData'];
            $riskCheckData = new RiskCheckData();
            $riskCheckData->setRiskCheckResult($this->arrGet($data, 'riskCheckResult'));
            $riskCheckData->setRiskScore($this->arrGet($data, 'riskScore'));
            $riskCheckData->setThreeDSecureRequired($this->arrGet($data, 'threeDSecureRequired'));

            $result->setRiskCheckData($riskCheckData);
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

        if($this->arrGet($json, 'success') === false){
            $result->setSuccess(false);
            $result->setErrorMessage($this->arrGet($json, 'errorMessage'));
            $result->setErrorCode($this->arrGet($json, 'errorCode'));
            return $result;
        }

        $result->setSuccess(true);
        $result->setTransactionStatus($this->arrGet($json, 'transactionStatus'));
        $result->setUuid($this->arrGet($json, 'uuid'));
        $result->setMerchantTransactionId($this->arrGet($json, 'merchantTransactionId'));
        $result->setIncomingSettlementState($this->arrGet($json, 'incomingSettlementState'));
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

        if(isset($json['splits'])) {
            $splits = $this->parseTransactionSplits($json['splits']);
            $result->setTransactionSplits($splits);
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

        if ($json['success']) {
            $result->setSuccess(true);
            $result->setScheduleId($this->arrGet($json, 'scheduleId'));
            $result->setRegistrationUuid($this->arrGet($json, 'registrationUuid'));
            $result->setOldStatus($this->arrGet($json, 'oldStatus'));
            $result->setNewStatus($this->arrGet($json, 'newStatus'));
            $result->setScheduledAt($this->arrGet($json, 'scheduledAt'));
            $result->setMerchantMetaData($this->arrGet($json, 'merchantMetaData'));
        } else {
            $result->setSuccess(false);
            $result->setErrorMessage($this->arrGet($json, 'errorMessage'));
            $result->setErrorCode($this->arrGet($json, 'errorCode'));
        }

        return $result;

    }

    /**
     * @param $jsonString
     *
     * @return OptionsResult
     */
    public function parseOptionsResult($jsonString){

        $json = json_decode($jsonString, true);

        $result = new OptionsResult();
        $result->setSuccess($json['success']);
        $result->setOptions($this->arrGet($json, 'options'));
        $result->setErrorMessage($this->arrGet($json, 'errorMessage'));

        return $result;
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
        $result->setErrorMessage($this->arrGet($json, 'errorMessage'));
        $result->setErrorCode($this->arrGet($json, 'errorCode'));
        $result->setAdapterMessage($this->arrGet($json, 'adapterMessage'));
        $result->setAdapterCode($this->arrGet($json, 'adapterCode'));

        // process objects
        if(isset($json['scheduleData'])) {
            $schedule = $this->parseScheduleData($json['scheduleData']);
            $result->setScheduleData($schedule);
        }

        if ($this->arrGet($json, 'message') || $this->arrGet($json, 'code')) {
            $result->addError(
                new Error(
                    $this->arrGet($json, 'message'),
                    $this->arrGet($json, 'code'),
                    $this->arrGet($json, 'adapterMessage'),
                    $this->arrGet($json, 'adapterCode')
                )
            );
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

        switch($returnData['_TYPE']){
            case 'cardData':
                $creditcardData = new ReturnCardData();
                $creditcardData->setType($this->arrGet($returnData, 'type'));
                $creditcardData->setFirstName($this->arrGet($returnData, 'firstName'));
                $creditcardData->setLastName($this->arrGet($returnData, 'lastName'));
                $creditcardData->setCountry($this->arrGet($returnData, 'country'));
                $creditcardData->setCardHolder($this->arrGet($returnData, 'cardHolder'));
                $creditcardData->setExpiryMonth($this->arrGet($returnData, 'expiryMonth'));
                $creditcardData->setExpiryYear($this->arrGet($returnData, 'expiryYear'));
                $creditcardData->setLastFourDigits($this->arrGet($returnData, 'lastFourDigits'));
                $creditcardData->setFingerprint($this->arrGet($returnData, 'fingerprint'));
                $creditcardData->setBinBrand($this->arrGet($returnData, 'binBrand'));
                $creditcardData->setBinBank($this->arrGet($returnData, 'binBank'));
                $creditcardData->setBinType($this->arrGet($returnData, 'binType'));
                $creditcardData->setBinLevel($this->arrGet($returnData, 'binLevel'));
                $creditcardData->setBinCountry($this->arrGet($returnData, 'binCountry'));
                $creditcardData->setThreeDSecure($this->arrGet($returnData, 'threeDSecure'));
                $creditcardData->setEci($this->arrGet($returnData, 'eci'));
                $creditcardData->setSchemeTransactionIdentifier($this->arrGet($returnData, 'schemeTransactionIdentifier'));

                if($this->arrGet($returnData, 'binDigits')){
                    $binDigits = $this->arrGet($returnData, 'binDigits');
                } else {
                    $binDigits = $this->arrGet($returnData, 'firstSixDigits');
                }

                $creditcardData->setBinDigits($binDigits);


                return $creditcardData;

            case 'phoneData':
                $phoneData = new ReturnPhoneData();
                $phoneData->setPhoneNumber($this->arrGet($returnData, 'phoneNumber'));
                $phoneData->setCountry($this->arrGet($returnData, 'country'));
                $phoneData->setOperator($this->arrGet($returnData, 'operator'));

                return $phoneData;

            case 'ibanData':
                $ibanData = new ReturnIbanData();
                $ibanData->setAccountOwner($this->arrGet($returnData, 'accountOwner'));
                $ibanData->setIban($this->arrGet($returnData, 'iban'));
                $ibanData->setBic($this->arrGet($returnData, 'bic'));
                $ibanData->setBankName($this->arrGet($returnData, 'bankName'));
                $ibanData->setCountry($this->arrGet($returnData, 'country'));

                return $ibanData;

            case 'walletData':
                $walletData = new ReturnWalletData();
                $walletData->setWalletOwner($this->arrGet($returnData, 'walletOwner'));
                $walletData->setWalletReferenceId($this->arrGet($returnData, 'walletReferenceId'));
                $walletData->setWalletType($this->arrGet($returnData, 'walletType'));
                $walletData->setWalletOwnerFirstName($this->arrGet($returnData, 'walletOwnerFirstName'));
                $walletData->setWalletOwnerLastName($this->arrGet($returnData, 'walletOwnerLastName'));
                $walletData->setWalletOwnerCountryCode($this->arrGet($returnData, 'walletOwnerCountryCode'));

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
        $scheduleData->setMerchantMetaData($this->arrGet($data, 'merchantMetaData'));

        return $scheduleData;
    }

    /**
     * @param $data
     *
     * @return Customer
     * @throws \Exception
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
        $customer->setExtraData($this->arrGet($data, 'extraData'));

        return $customer;
    }

    /**
     * @param $data
     *
     * @return Error
     */
    protected function parseError($data){
        $error = new Error(
            $this->arrGet($data, 'errorMessage') ?: $this->arrGet($data, 'message'),
            $this->arrGet($data, 'errorCode') ?: $this->arrGet($data, 'code'),
            $this->arrGet($data, 'adapterMessage'),
            $this->arrGet($data, 'adapterCode')
        );

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
        $cbData->setOriginalMerchantTransactionId($this->arrGet($data, 'originalMerchantTransactionId'));
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
        $cbrData->setOriginalMerchantTransactionId($this->arrGet($data, 'originalMerchantTransactionId'));
        $cbrData->setChargebackUuid($this->arrGet($data, 'chargebackUuid'));
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
        $customerProfileData->setPaymentToken($this->arrGet($data, 'paymentToken'));

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

    /**
     * @param $data
     *
     * @return TransactionSplit
     */
    protected function parseTransactionSplit($data){
        $split = new TransactionSplit();
        $split->setTransactionInternalId($this->arrGet($data, 'identification'));
        $split->setAmount($this->arrGet($data, 'amount'));
        $split->setCurrency($this->arrGet($data, 'currency'));
        $split->setSellerMerchantGuid($this->arrGet($data, 'sellerMerchantGuid'));
        $split->setSellerMerchantExternalId($this->arrGet($data, 'sellerMerchantExternalId'));

        if (isset($data['commissionFee'])) {
            $commissionFee = $data['commissionFee'];
            $split->setCommissionFeeAmount($this->arrGet($commissionFee, 'amount'));
            $split->setCommissionFeeCurrency($this->arrGet($commissionFee, 'currency'));
        }

        return $split;
    }

    /**
     * @param $data
     *
     * @return array
     */
    protected function parseTransactionSplits($data){
        $splits = [];
        foreach($data as $split){
            $splits[] = $this->parseTransactionSplit($split);
        }
        return $splits;
    }
}
