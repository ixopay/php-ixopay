<?php

namespace Ixopay\Client\Data;

use Ixopay\Client\Json\DataObject;

/**
 * Class ThreeDSecureData
 *
 * @package Ixopay\Client\Data
 *
 * @property string threeDSecure
 * @property string channel
 * @property string authenticationIndicator
 * @property string cardholderAuthenticationMethod
 * @property string cardholderAuthenticationDateTime
 * @property string cardHolderAuthenticationData
 * @property string challengeIndicator
 * @property string priorReference
 * @property string priorAuthenticationMethod
 * @property string priorAuthenticationDateTime
 * @property string priorAuthenticationData
 * @property string cardholderAccountType
 * @property string cardholderAccountDate
 * @property string cardHolderAccountChangeIndicator
 * @property string cardholderAccountLastChange
 * @property string cardholderAccountPasswordChangeIndicator
 * @property string cardholderAccountLastPasswordChange
 * @property string shippingAddressUsageIndicator
 * @property string shippingAddressFirstUsage
 * @property string transactionActivityDay
 * @property string transactionActivityYear
 * @property string addCardAttemptsDay
 * @property string purchaseCountSixMonths
 * @property string suspiciousAccountActivityIndicator
 * @property string shippingNameEqualIndicator
 * @property string paymentAccountAgeIndicator
 * @property string paymentAccountAgeDate
 * @property boolean billingShippingAddressMatch
 * @property string homePhoneCountryPrefix
 * @property string homePhoneNumber
 * @property string mobilePhoneCountryPrefix
 * @property string mobilePhoneNumber
 * @property string workPhoneCountryPrefix
 * @property string workPhoneNumber
 * @property int purchaseInstalData
 * @property string shipIndicator
 * @property string deliveryTimeframe
 * @property string deliveryEmailAddress
 * @property string reorderItemsIndicator
 * @property string preOrderPurchaseIndicator
 * @property string preOrderDate
 * @property float giftCardAmount
 * @property string giftCardCurrency
 * @property int giftCardCount
 * @property string purchaseDate
 * @property string recurringExpiry
 * @property int recurringFrequency
 * @property string transType
 * @property string browserChallengeWindowSize
 * @property string browserAcceptHeader
 * @property string browserIpAddress
 * @property string browserJavaEnabled
 * @property string browserLanguage
 * @property string browserColorDepth
 * @property int browserScreenHeight
 * @property int browserScreenWidth
 * @property string browserTimezone
 * @property string browserUserAgent
 * @property string sdkInterface
 * @property string sdkUiType
 * @property string sdkAppID
 * @property string sdkEncData
 * @property string sdkEphemPubKey
 * @property int sdkMaxTimeout
 * @property string sdkReferenceNumber
 * @property string sdkTransID
 *
 * @method string get3dsecure()
 * @method void set3dsecure(string $value)
 * @method string getChannel()
 * @method void setChannel(string $value)
 * @method string getAuthenticationIndicator()
 * @method void setAuthenticationIndicator(string $value)
 * @method string getCardholderAuthenticationMethod()
 * @method void setCardholderAuthenticationMethod(string $value)
 * @method string getCardholderAuthenticationDateTime()
 * @method void setCardholderAuthenticationDateTime(string $value)
 * @method string getCardHolderAuthenticationData()
 * @method void setCardHolderAuthenticationData(string $value)
 * @method string getChallengeIndicator()
 * @method void setChallengeIndicator(string $value)
 * @method string getPriorReference()
 * @method void setPriorReference(string $value)
 * @method string getPriorAuthenticationMethod()
 * @method void setPriorAuthenticationMethod(string $value)
 * @method string getPriorAuthenticationDateTime()
 * @method void setPriorAuthenticationDateTime(string $value)
 * @method string getPriorAuthenticationData()
 * @method void setPriorAuthenticationData(string $value)
 * @method string getCardholderAccountType()
 * @method void setCardholderAccountType(string $value)
 * @method string getCardholderAccountDate()
 * @method void setCardholderAccountDate(string $value)
 * @method string getCardHolderAccountChangeIndicator()
 * @method void setCardHolderAccountChangeIndicator(string $value)
 * @method string getCardholderAccountLastChange()
 * @method void setCardholderAccountLastChange(string $value)
 * @method string getCardholderAccountPasswordChangeIndicator()
 * @method void setCardholderAccountPasswordChangeIndicator(string $value)
 * @method string getCardholderAccountLastPasswordChange()
 * @method void setCardholderAccountLastPasswordChange(string $value)
 * @method string getShippingAddressUsageIndicator()
 * @method void setShippingAddressUsageIndicator(string $value)
 * @method string getShippingAddressFirstUsage()
 * @method void setShippingAddressFirstUsage(string $value)
 * @method string getTransactionActivityDay()
 * @method void setTransactionActivityDay(string $value)
 * @method string getTransactionActivityYear()
 * @method void setTransactionActivityYear(string $value)
 * @method string getAddCardAttemptsDay()
 * @method void setAddCardAttemptsDay(string $value)
 * @method string getPurchaseCountSixMonths()
 * @method void setPurchaseCountSixMonths(string $value)
 * @method string getSuspiciousAccountActivityIndicator()
 * @method void setSuspiciousAccountActivityIndicator(string $value)
 * @method string getShippingNameEqualIndicator()
 * @method void setShippingNameEqualIndicator(string $value)
 * @method string getPaymentAccountAgeIndicator()
 * @method void setPaymentAccountAgeIndicator(string $value)
 * @method string getPaymentAccountAgeDate()
 * @method void setPaymentAccountAgeDate(string $value)
 * @method boolean getBillingShippingAddressMatch()
 * @method void setBillingShippingAddressMatch(boolean $value)
 * @method string getHomePhoneCountryPrefix()
 * @method void setHomePhoneCountryPrefix(string $value)
 * @method string getHomePhoneNumber()
 * @method void setHomePhoneNumber(string $value)
 * @method string getMobilePhoneCountryPrefix()
 * @method void setMobilePhoneCountryPrefix(string $value)
 * @method string getMobilePhoneNumber()
 * @method void setMobilePhoneNumber(string $value)
 * @method string getWorkPhoneCountryPrefix()
 * @method void setWorkPhoneCountryPrefix(string $value)
 * @method string getWorkPhoneNumber()
 * @method void setWorkPhoneNumber(string $value)
 * @method int getPurchaseInstalData()
 * @method void setPurchaseInstalData(int $value)
 * @method string getShipIndicator()
 * @method void setShipIndicator(string $value)
 * @method string getDeliveryTimeframe()
 * @method void setDeliveryTimeframe(string $value)
 * @method string getDeliveryEmailAddress()
 * @method void setDeliveryEmailAddress(string $value)
 * @method string getReorderItemsIndicator()
 * @method void setReorderItemsIndicator(string $value)
 * @method string getPreOrderPurchaseIndicator()
 * @method void setPreOrderPurchaseIndicator(string $value)
 * @method string getPreOrderDate()
 * @method void setPreOrderDate(string $value)
 * @method float getGiftCardAmount()
 * @method void setGiftCardAmount(float $value)
 * @method string getGiftCardCurrency()
 * @method void setGiftCardCurrency(string $value)
 * @method int getGiftCardCount()
 * @method void setGiftCardCount(int $value)
 * @method string getPurchaseDate()
 * @method void setPurchaseDate(string $value)
 * @method string getRecurringExpiry()
 * @method void setRecurringExpiry(string $value)
 * @method int getRecurringFrequency()
 * @method void setRecurringFrequency(int $value)
 * @method string getTransType()
 * @method void setTransType(string $value)
 * @method string getBrowserChallengeWindowSize()
 * @method void setBrowserChallengeWindowSize(string $value)
 * @method string getBrowserAcceptHeader()
 * @method void setBrowserAcceptHeader(string $value)
 * @method string getBrowserIpAddress()
 * @method void setBrowserIpAddress(string $value)
 * @method string getBrowserJavaEnabled()
 * @method void setBrowserJavaEnabled(string $value)
 * @method string getBrowserLanguage()
 * @method void setBrowserLanguage(string $value)
 * @method string getBrowserColorDepth()
 * @method void setBrowserColorDepth(string $value)
 * @method int getBrowserScreenHeight()
 * @method void setBrowserScreenHeight(int $value)
 * @method int getBrowserScreenWidth()
 * @method void setBrowserScreenWidth(int $value)
 * @method string getBrowserTimezone()
 * @method void setBrowserTimezone(string $value)
 * @method string getBrowserUserAgent()
 * @method void setBrowserUserAgent(string $value)
 * @method string getSdkInterface()
 * @method void setSdkInterface(string $value)
 * @method string getSdkUiType()
 * @method void setSdkUiType(string $value)
 * @method string getSdkAppID()
 * @method void setSdkAppID(string $value)
 * @method string getSdkEncData()
 * @method void setSdkEncData(string $value)
 * @method string getSdkEphemPubKey()
 * @method void setSdkEphemPubKey(string $value)
 * @method string getSdkMaxTimeout()
 * @method int setSdkMaxTimeout(string $value)
 * @method string getSdkReferenceNumber()
 * @method void setSdkReferenceNumber(string $value)
 * @method string getSdkTransID()
 * @method void setSdkTransID(string $value)
 */
class ThreeDSecureData extends DataObject {

}