<?php

namespace Ixopay\Client\Json;

use Ixopay\Client\Callback\ChargebackData;
use Ixopay\Client\Callback\ChargebackReversalData;
use Ixopay\Client\Callback\Result as CallbackResult;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\Result\CreditcardData as ReturnCardData;
use Ixopay\Client\Data\Result\IbanData as ReturnIbanData;
use Ixopay\Client\Data\Result\PhoneData as ReturnPhoneData;
use Ixopay\Client\Data\Result\ResultData;
use Ixopay\Client\Data\Result\WalletData as ReturnWalletData;
use Ixopay\Client\Transaction\Error;

/**
 * Class JsonParser
 *
 * @package Ixopay\Client\Json
 */
class JsonParser {

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
        $result->setReferenceId($this->arrGet($json, 'uuid'));
        $result->setTransactionId($this->arrGet($json, 'merchantTransactionId'));
        $result->setPurchaseId($this->arrGet($json, 'purchaseId'));
        $result->setTransactionType($this->arrGet($json, 'transactionType'));
        $result->setPaymentMethod($this->arrGet($json, 'paymentMethod'));
        $result->setAmount($this->arrGet($json, 'amount'));
        $result->setCurrency($this->arrGet($json, 'currency'));
        $result->setMerchantMetaData($this->arrGet($json, 'merchantMetaData'));
        $result->setExtraData($this->arrGet($json, 'extraData'));
        if ($this->arrGet($json, 'errorMessage') || $this->arrGet($json, 'errorCode')) {
            $result->addError(
                new Error(
                    $this->arrGet($json, 'errorMessage'),
                    $this->arrGet($json, 'errorCode'),
                    $this->arrGet($json, 'adapterMessage'),
                    $this->arrGet($json, 'adapterCode')
                )
            );
        }


        // process objects
        if(isset($json['scheduleData'])) {
            //not yet available
            /*$schedule = $this->parseScheduleData($json['scheduleData']);
            $result->setScheduleData($schedule);*/
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
            //not yet available
            /*$customerProfileData = $this->parseCustomerProfileData($json['customerProfileData']);
            $result->setCustomerProfileData($customerProfileData);*/
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
                $creditcardData->setFirstSixDigits($this->arrGet($returnData, 'firstSixDigits'));
                $creditcardData->setLastFourDigits($this->arrGet($returnData, 'lastFourDigits'));
                $creditcardData->setFingerprint($this->arrGet($returnData, 'fingerprint'));
                $creditcardData->setBinBrand($this->arrGet($returnData, 'binBrand'));
                $creditcardData->setBinBank($this->arrGet($returnData, 'binBank'));
                $creditcardData->setBinType($this->arrGet($returnData, 'binType'));
                $creditcardData->setBinLevel($this->arrGet($returnData, 'binLevel'));
                $creditcardData->setBinCountry($this->arrGet($returnData, 'binCountry'));
                $creditcardData->setThreeDSecure($this->arrGet($returnData, 'threeDSecure'));
                $creditcardData->setEci($this->arrGet($returnData, 'eci'));

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
        /*$scheduleData = new ScheduleResultData();
        $scheduleData->setScheduleId($this->arrGet($data, 'scheduleId'));
        $scheduleData->setScheduleStatus($this->arrGet($data, 'scheduleStatus'));
        $scheduleData->setScheduledAt($this->arrGet($data, 'scheduledAt') ? new \DateTime($this->arrGet($data, 'scheduledAt')) : null);

        return $scheduleData;*/
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
            $this->arrGet($data, 'errorMessage'),
            $this->arrGet($data, 'errorCode'),
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
        $cbData->setOriginalReferenceId($this->arrGet($data, 'originalUuid'));
        $cbData->setOriginalTransactionId($this->arrGet($data, 'originalMerchantTransactionId'));
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
        $cbrData->setOriginalReferenceId($this->arrGet($data, 'originalUuid'));
        $cbrData->setOriginalTransactionId($this->arrGet($data, 'originalMerchantTransactionId'));
        $cbrData->setChargebackReferenceId($this->arrGet($data, 'chargebackUuid'));
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
        /*$customerProfileData = new CustomerProfileData();
        $customerProfileData->setProfileGuid($this->arrGet($data, 'profileGuid'));
        $customerProfileData->setCustomerIdentification($this->arrGet($data, 'customerIdentification'));

        return $customerProfileData;*/
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