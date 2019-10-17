<?php

namespace Ixopay\Client\Json;

use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\CustomerProfileData;
use Ixopay\Client\Data\Item;
use Ixopay\Client\Data\PaymentData\CardData;
use Ixopay\Client\Data\PaymentData\IbanData;
use Ixopay\Client\Data\PaymentData\PaymentData;
use Ixopay\Client\Data\PaymentData\WalletData;
use Ixopay\Client\Data\ThreeDSecureData;
use Ixopay\Client\Schedule\ScheduleData;
use Ixopay\Client\Transaction\Base\AbstractTransaction;
use Ixopay\Client\Transaction\Capture;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Deregister;
use Ixopay\Client\Transaction\Payout;
use Ixopay\Client\Transaction\Preauthorize;
use Ixopay\Client\Transaction\Refund;
use Ixopay\Client\Transaction\Register;
use Ixopay\Client\Transaction\VoidTransaction;

/**
 * Class Generator
 *
 * @package Ixopay\Client\Json
 */
class JsonGenerator {

    public function generateTransaction($method, AbstractTransaction $transaction, $language=null) {

//        if (strpos($method, 'complete') === 0) {
//
//        }

        // common
        $json = [
            'merchantTransactionId' => $transaction->getTransactionId(),
            'additionalId1' => $transaction->getAdditionalId1(),
            'additionalId2' => $transaction->getAdditionalId2(),
            'extraData' => $transaction->getExtraData(),
            'merchantMetaData' => $transaction->getMerchantMetaData(),
        ];

        // type specific
        switch($method){
            case 'debit':
                $json = array_merge($json, $this->createDebit($transaction, $language));
                break;
            case 'preauthorize':
                $json = array_merge($this->createPreauthorize($transaction, $language));
                break;
            case 'capture':
                $json = array_merge($this->createCapture($transaction));
                break;
            case 'void':
                $json = array_merge($this->createVoid($transaction));
                break;
            case 'register':
                $json = array_merge($this->createRegister($transaction, $language));
                break;
            case 'deregister':
                $json = array_merge($this->createDeregister($transaction));
                break;
            case 'refund':
                $json = array_merge($this->createRefund($transaction));
                break;
            case 'payout':
                $json = array_merge($this->createPayout($transaction, $language));
                break;
        }

    }

    /**
     * @param $transaction
     * @param $language
     *
     * @return array
     */
    protected function createDebit($transaction, $language){
        /** @var Debit $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceTransactionId(),
            'amount' => $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'successUrl' => $transaction->getSuccessUrl(),
            'cancelUrl' => $transaction->getCancelUrl(),
            'errorUrl' => $transaction->getErrorUrl(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'items' => $this->createItems($transaction->getItems()),
            'withRegister' => $transaction->isWithRegister(),
            'transactionIndicator' => $transaction->getTransactionIndicator(),
            'customer' => $this->createCustomer($transaction->getCustomer()),
            'paymentData' => $this->createPaymentData($transaction->getPaymentData()),
            'schedule' => $this->createSchedule($transaction->getSchedule()),
            'addToCustomerProfile' => $this->createAddToCustomerProfile($transaction->getCustomerProfileData()),
            'threeDSecureData' => $this->createThreeDSecureData($transaction->getThreeDSecureData()),
            'language' => $language,
        ];

        return $data;
    }

    /**
     * @param $transaction
     * @param $language
     *
     * @return array
     */
    protected function createPreauthorize($transaction, $language){
        /** @var Preauthorize $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceTransactionId(),
            'amount' => $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'successUrl' => $transaction->getSuccessUrl(),
            'cancelUrl' => $transaction->getCancelUrl(),
            'errorUrl' => $transaction->getErrorUrl(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'items' => $this->createItems($transaction->getItems()),
            'withRegister' => $transaction->isWithRegister(),
            'transactionIndicator' => $transaction->getTransactionIndicator(),
            'customer' => $this->createCustomer($transaction->getCustomer()),
            'paymentData' => $this->createPaymentData($transaction->getPaymentData()),
            'schedule' => $this->createSchedule($transaction->getSchedule()),
            'addToCustomerProfile' => $this->createAddToCustomerProfile($transaction->getCustomerProfileData()),
            'threeDSecureData' => $this->createThreeDSecureData($transaction->getThreeDSecureData()),
            'language' => $language,
        ];

        return $data;
    }

    /**
     * @param $transaction
     *
     * @return array
     */
    protected function createCapture($transaction){
        /** @var Capture $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceTransactionId(),
            'amount' => $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'items' => $this->createItems($transaction->getItems()),
        ];

        return $data;
    }

    /**
     * @param $transaction
     *
     * @return array
     */
    protected function createVoid($transaction){
        /** @var VoidTransaction $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceTransactionId(),
        ];

        return $data;
    }

    /**
     * @param $transaction
     * @param $language
     *
     * @return array
     */
    protected function createRegister($transaction, $language){
        /** @var Register $transaction */
        $data = [
            'successUrl' => $transaction->getSuccessUrl(),
            'cancelUrl' => $transaction->getCancelUrl(),
            'errorUrl' => $transaction->getErrorUrl(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'customer' => $this->createCustomer($transaction->getCustomer()),
            'paymentData' => $this->createPaymentData($transaction->getPaymentData()),
            'schedule' => $this->createSchedule($transaction->getSchedule()),
            'addToCustomerProfile' => $this->createAddToCustomerProfile($transaction->getCustomerProfileData()),
            'threeDSecureData' => $this->createThreeDSecureData($transaction->getThreeDSecureData()),
            'language' => $language,
        ];

        return $data;
    }

    /**
     * @param $transaction
     *
     * @return array
     */
    protected function createDeregister($transaction){
        /** @var Deregister $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceTransactionId(),
        ];

        return $data;
    }

    /**
     * @param $transaction
     *
     * @return array
     */
    protected function createRefund($transaction){
        /** @var Refund $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceTransactionId(),
            'amount' => $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'items' => $this->createItems($transaction->getItems()),
        ];

        return $data;
    }

    /**
     * @param $transaction
     * @param $language
     *
     * @return array
     */
    protected function createPayout($transaction, $language){
        /** @var Payout $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceTransactionId(),
            'amount' => $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'items' => $this->createItems($transaction->getItems()),
            'customer' => $this->createCustomer($transaction->getCustomer()),
            'paymentData' => $this->createPaymentData($transaction->getPaymentData()),
            'language' => $language,
        ];

        return $data;
    }

    /**
     * @param $items
     *
     * @return array
     */
    protected function createItems($items){

        if(!$items){
            return null;
        }

        $data = [];

        /** @var Item $item */
        foreach($items as $item){
            $data = [
                'identification' => $item->getIdentification(),
                'name' => $item->getName(),
                'description' => $item->getDescription(),
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'currency' => $item->getCurrency(),
                'extraData' => $item->getExtraData(),
            ];
        }

        return $data;
    }

    /**
     * @param Customer|null $customer
     *
     * @return mixed
     */
    protected function createCustomer($customer){

        if(!$customer){
            return null;
        }

        $data = [
            'identification' => $customer->getIdentification(),
            'firstName' => $customer->getFirstName(),
            'lastName' => $customer->getLastName(),
            'birthDate' => $customer->getBirthDate(),
            'gender' => $customer->getGender(),
            'billingAddress1' => $customer->getBillingAddress1(),
            'billingAddress2' => $customer->getBillingAddress2(),
            'billingCity' => $customer->getBillingCity(),
            'billingPostcode' => $customer->getBillingPostcode(),
            'billingState' => $customer->getBillingState(),
            'billingCountry' => $customer->getBillingCountry(),
            'billingPhone' => $customer->getBillingPhone(),
            'shippingFirstName' => $customer->getShippingFirstName(),
            'shippingLastName' => $customer->getShippingLastName(),
            'shippingCompany' => $customer->getShippingCompany(),
            'shippingAddress1' => $customer->getShippingAddress1(),
            'shippingAddress2' => $customer->getShippingAddress2(),
            'shippingCity' => $customer->getShippingCity(),
            'shippingPostcode' => $customer->getShippingPostcode(),
            'shippingState' => $customer->getShippingState(),
            'shippingCountry' => $customer->getShippingCountry(),
            'shippingPhone' => $customer->getShippingPhone(),
            'company' => $customer->getCompany(),
            'email' => $customer->getEmail(),
            'emailVerified' => $customer->isEmailVerified(),
            'ipAddress' => $customer->getIpAddress(),
            'nationalId' => $customer->getNationalId(),
            'extraData' => $customer->getExtraData(),
        ];

        return $data;
    }

    /**
     * @param PaymentData $paymentData
     *
     * @return array|null
     */
    protected function createPaymentData($paymentData){

        if(!$paymentData){
            return null;
        }

        if($paymentData instanceof CardData){
            /** @var CardData $paymentData */
            $data = [
                'brand' => $paymentData->getBrand(),
                'cardHolder' => $paymentData->getCardHolder(),
                'firstSixDigits' => $paymentData->getFirstSixDigits(),
                'lastFourDigits' => $paymentData->getLastFourDigits(),
                'expiryMonth' => $paymentData->getExpiryMonth(),
                'expiryYear' => $paymentData->getExpiryYear(),
            ];
        } elseif($paymentData instanceof IbanData){
            $data = [
                'iban' => $paymentData->getIban(),
                'bic' => $paymentData->getBic(),
                'mandateId' => $paymentData->getMandateId(),
                'mandateDate' => $paymentData->getMandateDate(),
            ];
        } elseif($paymentData instanceof WalletData){
            $data = [

            ];
        }

        return $data;

    }

    /**
     * @param ScheduleData $schedule
     *
     * @return array|null
     */
    protected function createSchedule($schedule){

        if(!$schedule){
            return null;
        }

        $data = [
            'amount' => $schedule->getAmount(),
            'currency' => $schedule->getCurrency(),
            'periodLength' => $schedule->getPeriodLength(),
            'periodUnit' => $schedule->getPeriodUnit(),
            'startDateTime' => $schedule->getStartDateTime(),
        ];

        return $data;
    }

    /**
     * @param CustomerProfileData $customerProfile
     *
     * @return array|null
     */
    protected function createAddToCustomerProfile(CustomerProfileData $customerProfile){
        if ($customerProfile) {
            return null;
        }

        $data = [
            'profileGuid' => $customerProfile->getProfileGuid(),
            'customerIdentification' => $customerProfile->getCustomerIdentification(),
            'markAsPreferred' => $customerProfile->getMarkAsPreferred()
        ];

        return $data;
    }


    /**
     * @param ThreeDSecureData $threeDSecureData
     *
     * @return array|null
     */
    protected function createThreeDSecureData($threeDSecureData){

        if(!$threeDSecureData){
            return null;
        }

        $data = [
            '3dsecure' => $threeDSecureData->get3dsecure(),
            'channel' => $threeDSecureData->getChannel(),
            'authenticationIndicator' => $threeDSecureData->getAuthenticationIndicator(),
            'cardholderAuthenticationMethod' => $threeDSecureData->getCardholderAuthenticationMethod(),
            'cardholderAuthenticationDateTime' => $threeDSecureData->getCardholderAuthenticationDateTime(),
            'cardHolderAuthenticationData' => $threeDSecureData->getCardHolderAuthenticationData(),
            'challengeIndicator' => $threeDSecureData->getChallengeIndicator(),
            'priorReference' => $threeDSecureData->getPriorReference(),
            'priorAuthenticationMethod' => $threeDSecureData->getPriorAuthenticationMethod(),
            'priorAuthenticationDateTime' => $threeDSecureData->getPriorAuthenticationDateTime(),
            'priorAuthenticationData' => $threeDSecureData->getPriorAuthenticationData(),
            'cardholderAccountType' => $threeDSecureData->getCardholderAccountType(),
            'cardholderAccountDate' => $threeDSecureData->getCardholderAccountDate(),
            'cardHolderAccountChangeIndicator' => $threeDSecureData->getCardHolderAccountChangeIndicator(),
            'cardholderAccountLastChange' => $threeDSecureData->getCardholderAccountLastChange(),
            'cardholderAccountPasswordChangeIndicator' => $threeDSecureData->getCardholderAccountPasswordChangeIndicator(),
            'cardholderAccountLastPasswordChange' => $threeDSecureData->getCardholderAccountLastPasswordChange(),
            'shippingAddressUsageIndicator' => $threeDSecureData->getShippingAddressUsageIndicator(),
            'shippingAddressFirstUsage' => $threeDSecureData->getShippingAddressFirstUsage(),
            'transactionActivityDay' => $threeDSecureData->getTransactionActivityDay(),
            'transactionActivityYear' => $threeDSecureData->getTransactionActivityYear(),
            'addCardAttemptsDay' => $threeDSecureData->getAddCardAttemptsDay(),
            'purchaseCountSixMonths' => $threeDSecureData->getPurchaseCountSixMonths(),
            'suspiciousAccountActivityIndicator' => $threeDSecureData->getSuspiciousAccountActivityIndicator(),
            'shippingNameEqualIndicator' => $threeDSecureData->getShippingNameEqualIndicator(),
            'paymentAccountAgeIndicator' => $threeDSecureData->getPaymentAccountAgeIndicator(),
            'paymentAccountAgeDate' => $threeDSecureData->getPaymentAccountAgeDate(),
            'billingShippingAddressMatch' => $threeDSecureData->getBillingShippingAddressMatch(),
            'homePhoneCountryPrefix' => $threeDSecureData->getHomePhoneCountryPrefix(),
            'homePhoneNumber' => $threeDSecureData->getHomePhoneNumber(),
            'mobilePhoneCountryPrefix' => $threeDSecureData->getMobilePhoneCountryPrefix(),
            'mobilePhoneNumber' => $threeDSecureData->getMobilePhoneNumber(),
            'workPhoneCountryPrefix' => $threeDSecureData->getWorkPhoneCountryPrefix(),
            'workPhoneNumber' => $threeDSecureData->getWorkPhoneNumber(),
            'purchaseInstalData' => $threeDSecureData->getPurchaseInstalData(),
            'shipIndicator' => $threeDSecureData->getShipIndicator(),
            'deliveryTimeframe' => $threeDSecureData->getDeliveryTimeframe(),
            'deliveryEmailAddress' => $threeDSecureData->getDeliveryEmailAddress(),
            'reorderItemsIndicator' => $threeDSecureData->getReorderItemsIndicator(),
            'preOrderPurchaseIndicator' => $threeDSecureData->getPreOrderPurchaseIndicator(),
            'preOrderDate' => $threeDSecureData->getPreOrderDate(),
            'giftCardAmount' => $threeDSecureData->getGiftCardAmount(),
            'giftCardCurrency' => $threeDSecureData->getGiftCardCurrency(),
            'giftCardCount' => $threeDSecureData->getGiftCardCount(),
            'purchaseDate' => $threeDSecureData->getPurchaseDate(),
            'recurringExpiry' => $threeDSecureData->getRecurringExpiry(),
            'recurringFrequency' => $threeDSecureData->getRecurringFrequency(),
            'transType' => $threeDSecureData->getTransType(),
            'browserChallengeWindowSize' => $threeDSecureData->getBrowserChallengeWindowSize(),
            'browserAcceptHeader' => $threeDSecureData->getBrowserAcceptHeader(),
            'browserIpAddress' => $threeDSecureData->getBrowserIpAddress(),
            'browserJavaEnabled' => $threeDSecureData->getBrowserJavaEnabled(),
            'browserLanguage' => $threeDSecureData->getBrowserLanguage(),
            'browserColorDepth' => $threeDSecureData->getBrowserColorDepth(),
            'browserScreenHeight' => $threeDSecureData->getBrowserScreenHeight(),
            'browserScreenWidth' => $threeDSecureData->getBrowserScreenWidth(),
            'browserTimezone' => $threeDSecureData->getBrowserTimezone(),
            'browserUserAgent' => $threeDSecureData->getBrowserUserAgent(),
            'sdkInterface' => $threeDSecureData->getSdkInterface(),
            'sdkUiType' => $threeDSecureData->getSdkUiType(),
            'sdkAppID' => $threeDSecureData->getSdkAppID(),
            'sdkEncData' => $threeDSecureData->getSdkEncData(),
            'sdkEphemPubKey' => $threeDSecureData->getSdkEphemPubKey(),
            'sdkMaxTimeout' => $threeDSecureData->getSdkMaxTimeout(),
            'sdkReferenceNumber' => $threeDSecureData->getSdkReferenceNumber(),
            'sdkTransID' => $threeDSecureData->getSdkTransID(),
        ];

        return $data;
    }

}