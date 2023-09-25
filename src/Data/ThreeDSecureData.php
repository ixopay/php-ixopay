<?php

namespace Ixopay\Client\Data;

use Ixopay\Client\Json\DataObject;

/**
 * Class ThreeDSecureData
 *
 * @package Ixopay\Client\Data
 */
class ThreeDSecureData extends DataObject
{
    const SCHEME_ID_CB = 'cb';

    /** @var string */
    protected $threeDSecure;

    /** @var string */
    protected $schemeId;

    /** @var string */
    protected $channel;

    /** @var string */
    protected $authenticationIndicator;

    /** @var string */
    protected $cardholderAuthenticationMethod;

    /** @var \DateTime */
    protected $cardholderAuthenticationDateTime;

    /** @var string */
    protected $cardHolderAuthenticationData;

    /** @var string */
    protected $challengeIndicator;

    /** @var string */
    protected $priorReference;

    /** @var string */
    protected $priorAuthenticationMethod;

    /** @var \DateTime */
    protected $priorAuthenticationDateTime;

    /** @var string */
    protected $priorAuthenticationData;

    /** @var string */
    protected $cardholderAccountType;

    /** @var \DateTime */
    protected $cardholderAccountDate;

    /** @var string */
    protected $cardholderAccountChangeIndicator;

    /** @var \DateTime */
    protected $cardholderAccountLastChange;

    /** @var string */
    protected $cardholderAccountPasswordChangeIndicator;

    /** @var \DateTime */
    protected $cardholderAccountLastPasswordChange;

    /** @var string */
    protected $shippingAddressUsageIndicator;

    /** @var \DateTime */
    protected $shippingAddressFirstUsage;

    /** @var int */
    protected $transactionActivityDay;

    /** @var int */
    protected $transactionActivityYear;

    /** @var int */
    protected $addCardAttemptsDay;

    /** @var int */
    protected $purchaseCountSixMonths;

    /** @var string */
    protected $suspiciousAccountActivityIndicator;

    /** @var string */
    protected $shippingNameEqualIndicator;

    /** @var string */
    protected $paymentAccountAgeIndicator;

    /** @var \DateTime */
    protected $paymentAccountAgeDate;

    /** @var string */
    protected $billingShippingAddressMatch;

    /** @var string */
    protected $homePhoneCountryPrefix;

    /** @var string */
    protected $homePhoneNumber;

    /** @var string */
    protected $mobilePhoneCountryPrefix;

    /** @var string */
    protected $mobilePhoneNumber;

    /** @var string */
    protected $workPhoneCountryPrefix;

    /** @var string */
    protected $workPhoneNumber;

    /** @var int */
    protected $purchaseInstalData;

    /** @var string */
    protected $shipIndicator;

    /** @var string */
    protected $deliveryTimeframe;

    /** @var string */
    protected $deliveryEmailAddress;

    /** @var string */
    protected $reorderItemsIndicator;

    /** @var string */
    protected $preOrderPurchaseIndicator;

    /** @var \DateTime */
    protected $preOrderDate;

    /** @var float */
    protected $giftCardAmount;

    /** @var string */
    protected $giftCardCurrency;

    /** @var int */
    protected $giftCardCount;

    /** @var \DateTime */
    protected $purchaseDate;

    /** @var \DateTime */
    protected $recurringExpiry;

    /** @var int */
    protected $recurringFrequency;

    /** @var string */
    protected $transType;

    /** @var string */
    protected $browserChallengeWindowSize;

    /** @var string */
    protected $browserAcceptHeader;

    /** @var string */
    protected $browserIpAddress;

    /** @var boolean */
    protected $browserJavaEnabled;

    /** @var string */
    protected $browserLanguage;

    /** @var string */
    protected $browserColorDepth;

    /** @var int */
    protected $browserScreenHeight;

    /** @var int */
    protected $browserScreenWidth;

    /** @var string */
    protected $browserTimezone;

    /** @var string */
    protected $browserUserAgent;

    /** @var string */
    protected $sdkInterface;

    /** @var string */
    protected $sdkUiType;

    /** @var string */
    protected $sdkAppID;

    /** @var string */
    protected $sdkEncData;

    /** @var string */
    protected $sdkEphemPubKey;

    /** @var int */
    protected $sdkMaxTimeout;

    /** @var string */
    protected $sdkReferenceNumber;

    /** @var string */
    protected $sdkTransID;

    /** @var string */
    protected $exemptionIndicator;

    /** @var string */
    protected $cardholderAccountAgeIndicator;

    /** @var string */
    protected $billingAddressLine3;

    /** @var string */
    protected $shippingAddressLine3;

    /** @var string */
    protected $billingAddressState;

    /** @var string */
    protected $shippingAddressState;

    /** @var string */
    protected $browserPlatform;

    /**
     * @return string
     */
    public function getThreeDSecure()
    {
        return $this->threeDSecure;
    }

    /**
     * @param string $threeDSecure
     *
     * @return ThreeDSecureData
     */
    public function setThreeDSecure($threeDSecure)
    {
        $this->threeDSecure = $threeDSecure;
        return $this;
    }

    /**
     * Pin scheme ID.
     *
     * Use self::SCHEME_ID_* constants only!
     *
     * @param  string $schemeId
     * @return ThreeDSecureData
     */
    public function setSchemeId($schemeId)
    {
        $this->schemeId = $schemeId;

        return $this;
    }

    public function getSchemeId()
    {
        return $this->schemeId;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string $channel
     *
     * @return ThreeDSecureData
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthenticationIndicator()
    {
        return $this->authenticationIndicator;
    }

    /**
     * @param string $authenticationIndicator
     *
     * @return ThreeDSecureData
     */
    public function setAuthenticationIndicator($authenticationIndicator)
    {
        $this->authenticationIndicator = $authenticationIndicator;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardholderAuthenticationMethod()
    {
        return $this->cardholderAuthenticationMethod;
    }

    /**
     * @param string $cardholderAuthenticationMethod
     *
     * @return ThreeDSecureData
     */
    public function setCardholderAuthenticationMethod($cardholderAuthenticationMethod)
    {
        $this->cardholderAuthenticationMethod = $cardholderAuthenticationMethod;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCardholderAuthenticationDateTime()
    {
        return $this->cardholderAuthenticationDateTime;
    }

    /**
     * @return string
     */
    public function getCardholderAuthenticationDateTimeFormatted()
    {
        return $this->cardholderAuthenticationDateTime ? $this->cardholderAuthenticationDateTime->format('Y-m-d H:i') : null;
    }

    /**
     * @param \DateTime|string $cardholderAuthenticationDateTime
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setCardholderAuthenticationDateTime($cardholderAuthenticationDateTime)
    {
        if (is_string($cardholderAuthenticationDateTime) && !empty($cardholderAuthenticationDateTime)) {
            $cardholderAuthenticationDateTime = new \DateTime($cardholderAuthenticationDateTime);
        }
        $this->cardholderAuthenticationDateTime = $cardholderAuthenticationDateTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardHolderAuthenticationData()
    {
        return $this->cardHolderAuthenticationData;
    }

    /**
     * @param string $cardHolderAuthenticationData
     *
     * @return ThreeDSecureData
     */
    public function setCardHolderAuthenticationData($cardHolderAuthenticationData)
    {
        $this->cardHolderAuthenticationData = $cardHolderAuthenticationData;
        return $this;
    }

    /**
     * @return string
     */
    public function getChallengeIndicator()
    {
        return $this->challengeIndicator;
    }

    /**
     * @param string $challengeIndicator
     *
     * @return ThreeDSecureData
     */
    public function setChallengeIndicator($challengeIndicator)
    {
        $this->challengeIndicator = $challengeIndicator;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriorReference()
    {
        return $this->priorReference;
    }

    /**
     * @param string $priorReference
     *
     * @return ThreeDSecureData
     */
    public function setPriorReference($priorReference)
    {
        $this->priorReference = $priorReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriorAuthenticationMethod()
    {
        return $this->priorAuthenticationMethod;
    }

    /**
     * @param string $priorAuthenticationMethod
     *
     * @return ThreeDSecureData
     */
    public function setPriorAuthenticationMethod($priorAuthenticationMethod)
    {
        $this->priorAuthenticationMethod = $priorAuthenticationMethod;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPriorAuthenticationDateTime()
    {
        return $this->priorAuthenticationDateTime;
    }

    /**
     * @return string
     */
    public function getPriorAuthenticationDateTimeFormatted()
    {
        return $this->priorAuthenticationDateTime ? $this->priorAuthenticationDateTime->format('Y-m-d H:i') : null;
    }

    /**
     * @param \DateTime|string $priorAuthenticationDateTime
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setPriorAuthenticationDateTime($priorAuthenticationDateTime)
    {
        if (is_string($priorAuthenticationDateTime) && !empty($priorAuthenticationDateTime)) {
            $priorAuthenticationDateTime = new \DateTime($priorAuthenticationDateTime);
        }
        $this->priorAuthenticationDateTime = $priorAuthenticationDateTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriorAuthenticationData()
    {
        return $this->priorAuthenticationData;
    }

    /**
     * @param string $priorAuthenticationData
     *
     * @return ThreeDSecureData
     */
    public function setPriorAuthenticationData($priorAuthenticationData)
    {
        $this->priorAuthenticationData = $priorAuthenticationData;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardholderAccountType()
    {
        return $this->cardholderAccountType;
    }

    /**
     * @param string $cardholderAccountType
     *
     * @return ThreeDSecureData
     */
    public function setCardholderAccountType($cardholderAccountType)
    {
        $this->cardholderAccountType = $cardholderAccountType;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCardholderAccountDate()
    {
        return $this->cardholderAccountDate;
    }

    /**
     * @return string|null
     */
    public function getCardholderAccountDateFormatted()
    {
        return $this->cardholderAccountDate ? $this->cardholderAccountDate->format('Y-m-d') : null;
    }

    /**
     * @param \DateTime|string $cardholderAccountDate
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setCardholderAccountDate($cardholderAccountDate)
    {
        if (is_string($cardholderAccountDate) && !empty($cardholderAccountDate)) {
            $cardholderAccountDate = new \DateTime($cardholderAccountDate);
        }
        $this->cardholderAccountDate = $cardholderAccountDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardholderAccountChangeIndicator()
    {
        return $this->cardholderAccountChangeIndicator;
    }

    /**
     * @param string $cardholderAccountChangeIndicator
     *
     * @return ThreeDSecureData
     */
    public function setCardholderAccountChangeIndicator($cardholderAccountChangeIndicator)
    {
        $this->cardholderAccountChangeIndicator = $cardholderAccountChangeIndicator;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCardholderAccountLastChange()
    {
        return $this->cardholderAccountLastChange;
    }

    /**
     * @return string
     */
    public function getCardholderAccountLastChangeFormatted()
    {
        return $this->cardholderAccountLastChange ? $this->cardholderAccountLastChange->format('Y-m-d') : null;
    }

    /**
     * @param \DateTime|string $cardholderAccountLastChange
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setCardholderAccountLastChange($cardholderAccountLastChange)
    {
        if (is_string($cardholderAccountLastChange) && !empty($cardholderAccountLastChange)) {
            $cardholderAccountLastChange = new \DateTime($cardholderAccountLastChange);
        }
        $this->cardholderAccountLastChange = $cardholderAccountLastChange;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardholderAccountPasswordChangeIndicator()
    {
        return $this->cardholderAccountPasswordChangeIndicator;
    }

    /**
     * @param string $cardholderAccountPasswordChangeIndicator
     *
     * @return ThreeDSecureData
     */
    public function setCardholderAccountPasswordChangeIndicator($cardholderAccountPasswordChangeIndicator)
    {
        $this->cardholderAccountPasswordChangeIndicator = $cardholderAccountPasswordChangeIndicator;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCardholderAccountLastPasswordChange()
    {
        return $this->cardholderAccountLastPasswordChange;
    }

    /**
     * @return string|null
     */
    public function getCardholderAccountLastPasswordChangeFormatted()
    {
        return $this->cardholderAccountLastPasswordChange ? $this->cardholderAccountLastPasswordChange->format('Y-m-d') : null;
    }

    /**
     * @param \DateTime|string $cardholderAccountLastPasswordChange
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setCardholderAccountLastPasswordChange($cardholderAccountLastPasswordChange)
    {
        if (is_string($cardholderAccountLastPasswordChange) && !empty($cardholderAccountLastPasswordChange)) {
            $cardholderAccountLastPasswordChange = new \DateTime($cardholderAccountLastPasswordChange);
        }
        $this->cardholderAccountLastPasswordChange = $cardholderAccountLastPasswordChange;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAddressUsageIndicator()
    {
        return $this->shippingAddressUsageIndicator;
    }

    /**
     * @param string $shippingAddressUsageIndicator
     *
     * @return ThreeDSecureData
     */
    public function setShippingAddressUsageIndicator($shippingAddressUsageIndicator)
    {
        $this->shippingAddressUsageIndicator = $shippingAddressUsageIndicator;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getShippingAddressFirstUsage()
    {
        return $this->shippingAddressFirstUsage;
    }

    /**
     * @return string|null
     */
    public function getShippingAddressFirstUsageFormatted()
    {
        return $this->shippingAddressFirstUsage ? $this->shippingAddressFirstUsage->format('Y-m-d') : null;
    }

    /**
     * @param \DateTime|string $shippingAddressFirstUsage
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setShippingAddressFirstUsage($shippingAddressFirstUsage)
    {
        if (is_string($shippingAddressFirstUsage) && !empty($shippingAddressFirstUsage)) {
            $shippingAddressFirstUsage = new \DateTime($shippingAddressFirstUsage);
        }
        $this->shippingAddressFirstUsage = $shippingAddressFirstUsage;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionActivityDay()
    {
        return $this->transactionActivityDay;
    }

    /**
     * @param string $transactionActivityDay
     *
     * @return ThreeDSecureData
     */
    public function setTransactionActivityDay($transactionActivityDay)
    {
        $this->transactionActivityDay = $transactionActivityDay;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionActivityYear()
    {
        return $this->transactionActivityYear;
    }

    /**
     * @param string $transactionActivityYear
     *
     * @return ThreeDSecureData
     */
    public function setTransactionActivityYear($transactionActivityYear)
    {
        $this->transactionActivityYear = $transactionActivityYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddCardAttemptsDay()
    {
        return $this->addCardAttemptsDay;
    }

    /**
     * @param string $addCardAttemptsDay
     *
     * @return ThreeDSecureData
     */
    public function setAddCardAttemptsDay($addCardAttemptsDay)
    {
        $this->addCardAttemptsDay = $addCardAttemptsDay;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurchaseCountSixMonths()
    {
        return $this->purchaseCountSixMonths;
    }

    /**
     * @param string $purchaseCountSixMonths
     *
     * @return ThreeDSecureData
     */
    public function setPurchaseCountSixMonths($purchaseCountSixMonths)
    {
        $this->purchaseCountSixMonths = $purchaseCountSixMonths;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuspiciousAccountActivityIndicator()
    {
        return $this->suspiciousAccountActivityIndicator;
    }

    /**
     * @param string $suspiciousAccountActivityIndicator
     *
     * @return ThreeDSecureData
     */
    public function setSuspiciousAccountActivityIndicator($suspiciousAccountActivityIndicator)
    {
        $this->suspiciousAccountActivityIndicator = $suspiciousAccountActivityIndicator;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingNameEqualIndicator()
    {
        return $this->shippingNameEqualIndicator;
    }

    /**
     * @param string $shippingNameEqualIndicator
     *
     * @return ThreeDSecureData
     */
    public function setShippingNameEqualIndicator($shippingNameEqualIndicator)
    {
        $this->shippingNameEqualIndicator = $shippingNameEqualIndicator;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentAccountAgeIndicator()
    {
        return $this->paymentAccountAgeIndicator;
    }

    /**
     * @param string $paymentAccountAgeIndicator
     *
     * @return ThreeDSecureData
     */
    public function setPaymentAccountAgeIndicator($paymentAccountAgeIndicator)
    {
        $this->paymentAccountAgeIndicator = $paymentAccountAgeIndicator;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPaymentAccountAgeDate()
    {
        return $this->paymentAccountAgeDate;
    }

    /**
     * @return string|null
     */
    public function getPaymentAccountAgeDateFormatted()
    {
        return $this->paymentAccountAgeDate ? $this->paymentAccountAgeDate->format('Y-m-d') : null;
    }

    /**
     * @param \DateTime|string $paymentAccountAgeDate
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setPaymentAccountAgeDate($paymentAccountAgeDate)
    {
        if (is_string($paymentAccountAgeDate) && !empty($paymentAccountAgeDate)) {
            $paymentAccountAgeDate = new \DateTime($paymentAccountAgeDate);
        }
        $this->paymentAccountAgeDate = $paymentAccountAgeDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingShippingAddressMatch()
    {
        return $this->billingShippingAddressMatch;
    }

    /**
     * @param string $billingShippingAddressMatch
     *
     * @return ThreeDSecureData
     */
    public function setBillingShippingAddressMatch($billingShippingAddressMatch)
    {
        $this->billingShippingAddressMatch = $billingShippingAddressMatch;
        return $this;
    }

    /**
     * @return string
     */
    public function getHomePhoneCountryPrefix()
    {
        return $this->homePhoneCountryPrefix;
    }

    /**
     * @param string $homePhoneCountryPrefix
     *
     * @return ThreeDSecureData
     */
    public function setHomePhoneCountryPrefix($homePhoneCountryPrefix)
    {
        $this->homePhoneCountryPrefix = $homePhoneCountryPrefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getHomePhoneNumber()
    {
        return $this->homePhoneNumber;
    }

    /**
     * @param string $homePhoneNumber
     *
     * @return ThreeDSecureData
     */
    public function setHomePhoneNumber($homePhoneNumber)
    {
        $this->homePhoneNumber = $homePhoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobilePhoneCountryPrefix()
    {
        return $this->mobilePhoneCountryPrefix;
    }

    /**
     * @param string $mobilePhoneCountryPrefix
     *
     * @return ThreeDSecureData
     */
    public function setMobilePhoneCountryPrefix($mobilePhoneCountryPrefix)
    {
        $this->mobilePhoneCountryPrefix = $mobilePhoneCountryPrefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobilePhoneNumber()
    {
        return $this->mobilePhoneNumber;
    }

    /**
     * @param string $mobilePhoneNumber
     *
     * @return ThreeDSecureData
     */
    public function setMobilePhoneNumber($mobilePhoneNumber)
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkPhoneCountryPrefix()
    {
        return $this->workPhoneCountryPrefix;
    }

    /**
     * @param string $workPhoneCountryPrefix
     *
     * @return ThreeDSecureData
     */
    public function setWorkPhoneCountryPrefix($workPhoneCountryPrefix)
    {
        $this->workPhoneCountryPrefix = $workPhoneCountryPrefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkPhoneNumber()
    {
        return $this->workPhoneNumber;
    }

    /**
     * @param string $workPhoneNumber
     *
     * @return ThreeDSecureData
     */
    public function setWorkPhoneNumber($workPhoneNumber)
    {
        $this->workPhoneNumber = $workPhoneNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getPurchaseInstalData()
    {
        return $this->purchaseInstalData;
    }

    /**
     * @param int $purchaseInstalData
     *
     * @return ThreeDSecureData
     */
    public function setPurchaseInstalData($purchaseInstalData)
    {
        $this->purchaseInstalData = $purchaseInstalData;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipIndicator()
    {
        return $this->shipIndicator;
    }

    /**
     * @param string $shipIndicator
     *
     * @return ThreeDSecureData
     */
    public function setShipIndicator($shipIndicator)
    {
        $this->shipIndicator = $shipIndicator;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryTimeframe()
    {
        return $this->deliveryTimeframe;
    }

    /**
     * @param string $deliveryTimeframe
     *
     * @return ThreeDSecureData
     */
    public function setDeliveryTimeframe($deliveryTimeframe)
    {
        $this->deliveryTimeframe = $deliveryTimeframe;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryEmailAddress()
    {
        return $this->deliveryEmailAddress;
    }

    /**
     * @param string $deliveryEmailAddress
     *
     * @return ThreeDSecureData
     */
    public function setDeliveryEmailAddress($deliveryEmailAddress)
    {
        $this->deliveryEmailAddress = $deliveryEmailAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getReorderItemsIndicator()
    {
        return $this->reorderItemsIndicator;
    }

    /**
     * @param string $reorderItemsIndicator
     *
     * @return ThreeDSecureData
     */
    public function setReorderItemsIndicator($reorderItemsIndicator)
    {
        $this->reorderItemsIndicator = $reorderItemsIndicator;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreOrderPurchaseIndicator()
    {
        return $this->preOrderPurchaseIndicator;
    }

    /**
     * @param string $preOrderPurchaseIndicator
     *
     * @return ThreeDSecureData
     */
    public function setPreOrderPurchaseIndicator($preOrderPurchaseIndicator)
    {
        $this->preOrderPurchaseIndicator = $preOrderPurchaseIndicator;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPreOrderDate()
    {
        return $this->preOrderDate;
    }

    /**
     * @return string|null
     */
    public function getPreOrderDateFormatted()
    {
        return $this->preOrderDate ? $this->preOrderDate->format('Y-m-d') : null;
    }

    /**
     * @param \DateTime|string $preOrderDate
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setPreOrderDate($preOrderDate)
    {
        if (is_string($preOrderDate) && !empty($preOrderDate)) {
            $preOrderDate = new \DateTime($preOrderDate);
        }
        $this->preOrderDate = $preOrderDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getGiftCardAmount()
    {
        return $this->giftCardAmount;
    }

    /**
     * @param float $giftCardAmount
     *
     * @return ThreeDSecureData
     */
    public function setGiftCardAmount($giftCardAmount)
    {
        $this->giftCardAmount = $giftCardAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getGiftCardCurrency()
    {
        return $this->giftCardCurrency;
    }

    /**
     * @param string $giftCardCurrency
     *
     * @return ThreeDSecureData
     */
    public function setGiftCardCurrency($giftCardCurrency)
    {
        $this->giftCardCurrency = $giftCardCurrency;
        return $this;
    }

    /**
     * @return int
     */
    public function getGiftCardCount()
    {
        return $this->giftCardCount;
    }

    /**
     * @param int $giftCardCount
     *
     * @return ThreeDSecureData
     */
    public function setGiftCardCount($giftCardCount)
    {
        $this->giftCardCount = $giftCardCount;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * @return string|null
     */
    public function getPurchaseDateFormatted()
    {
        return $this->purchaseDate ? $this->purchaseDate->format('Y-m-d H:i') : null;
    }

    /**
     * @param \DateTime|string $purchaseDate
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setPurchaseDate($purchaseDate)
    {
        if (is_string($purchaseDate) && !empty($purchaseDate)) {
            $purchaseDate = new \DateTime($purchaseDate);
        }
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRecurringExpiry()
    {
        return $this->recurringExpiry;
    }

    /**
     * @return string|null
     */
    public function getRecurringExpiryFormatted()
    {
        return $this->recurringExpiry ? $this->recurringExpiry->format('Y-m-d') : null;
    }

    /**
     * @param \DateTime|string $recurringExpiry
     *
     * @return ThreeDSecureData
     * @throws \Exception
     */
    public function setRecurringExpiry($recurringExpiry)
    {
        if (is_string($recurringExpiry) && !empty($recurringExpiry)) {
            $recurringExpiry = new \DateTime($recurringExpiry);
        }
        $this->recurringExpiry = $recurringExpiry;
        return $this;
    }

    /**
     * @return int
     */
    public function getRecurringFrequency()
    {
        return $this->recurringFrequency;
    }

    /**
     * @param int $recurringFrequency
     *
     * @return ThreeDSecureData
     */
    public function setRecurringFrequency($recurringFrequency)
    {
        $this->recurringFrequency = $recurringFrequency;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransType()
    {
        return $this->transType;
    }

    /**
     * @param string $transType
     *
     * @return ThreeDSecureData
     */
    public function setTransType($transType)
    {
        $this->transType = $transType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowserChallengeWindowSize()
    {
        return $this->browserChallengeWindowSize;
    }

    /**
     * @param string $browserChallengeWindowSize
     *
     * @return ThreeDSecureData
     */
    public function setBrowserChallengeWindowSize($browserChallengeWindowSize)
    {
        $this->browserChallengeWindowSize = $browserChallengeWindowSize;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowserAcceptHeader()
    {
        return $this->browserAcceptHeader;
    }

    /**
     * @param string $browserAcceptHeader
     *
     * @return ThreeDSecureData
     */
    public function setBrowserAcceptHeader($browserAcceptHeader)
    {
        $this->browserAcceptHeader = $browserAcceptHeader;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowserIpAddress()
    {
        return $this->browserIpAddress;
    }

    /**
     * @param string $browserIpAddress
     *
     * @return ThreeDSecureData
     */
    public function setBrowserIpAddress($browserIpAddress)
    {
        $this->browserIpAddress = $browserIpAddress;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getBrowserJavaEnabled()
    {
        return $this->browserJavaEnabled;
    }

    /**
     * @param boolean $browserJavaEnabled
     *
     * @return ThreeDSecureData
     */
    public function setBrowserJavaEnabled($browserJavaEnabled)
    {
        $this->browserJavaEnabled = $browserJavaEnabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowserLanguage()
    {
        return $this->browserLanguage;
    }

    /**
     * @param string $browserLanguage
     *
     * @return ThreeDSecureData
     */
    public function setBrowserLanguage($browserLanguage)
    {
        $this->browserLanguage = $browserLanguage;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowserColorDepth()
    {
        return $this->browserColorDepth;
    }

    /**
     * @param string $browserColorDepth
     *
     * @return ThreeDSecureData
     */
    public function setBrowserColorDepth($browserColorDepth)
    {
        $this->browserColorDepth = $browserColorDepth;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrowserScreenHeight()
    {
        return $this->browserScreenHeight;
    }

    /**
     * @param int $browserScreenHeight
     *
     * @return ThreeDSecureData
     */
    public function setBrowserScreenHeight($browserScreenHeight)
    {
        $this->browserScreenHeight = $browserScreenHeight;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrowserScreenWidth()
    {
        return $this->browserScreenWidth;
    }

    /**
     * @param int $browserScreenWidth
     *
     * @return ThreeDSecureData
     */
    public function setBrowserScreenWidth($browserScreenWidth)
    {
        $this->browserScreenWidth = $browserScreenWidth;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowserTimezone()
    {
        return $this->browserTimezone;
    }

    /**
     * @param string $browserTimezone
     *
     * @return ThreeDSecureData
     */
    public function setBrowserTimezone($browserTimezone)
    {
        $this->browserTimezone = $browserTimezone;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowserUserAgent()
    {
        return $this->browserUserAgent;
    }

    /**
     * @param string $browserUserAgent
     *
     * @return ThreeDSecureData
     */
    public function setBrowserUserAgent($browserUserAgent)
    {
        $this->browserUserAgent = $browserUserAgent;
        return $this;
    }

    /**
     * @return string
     */
    public function getSdkInterface()
    {
        return $this->sdkInterface;
    }

    /**
     * @param string $sdkInterface
     *
     * @return ThreeDSecureData
     */
    public function setSdkInterface($sdkInterface)
    {
        $this->sdkInterface = $sdkInterface;
        return $this;
    }

    /**
     * @return string
     */
    public function getSdkUiType()
    {
        return $this->sdkUiType;
    }

    /**
     * @param string $sdkUiType
     *
     * @return ThreeDSecureData
     */
    public function setSdkUiType($sdkUiType)
    {
        $this->sdkUiType = $sdkUiType;
        return $this;
    }

    /**
     * @return string
     */
    public function getSdkAppID()
    {
        return $this->sdkAppID;
    }

    /**
     * @param string $sdkAppID
     *
     * @return ThreeDSecureData
     */
    public function setSdkAppID($sdkAppID)
    {
        $this->sdkAppID = $sdkAppID;
        return $this;
    }

    /**
     * @return string
     */
    public function getSdkEncData()
    {
        return $this->sdkEncData;
    }

    /**
     * @param string $sdkEncData
     *
     * @return ThreeDSecureData
     */
    public function setSdkEncData($sdkEncData)
    {
        $this->sdkEncData = $sdkEncData;
        return $this;
    }

    /**
     * @return string
     */
    public function getSdkEphemPubKey()
    {
        return $this->sdkEphemPubKey;
    }

    /**
     * @param string $sdkEphemPubKey
     *
     * @return ThreeDSecureData
     */
    public function setSdkEphemPubKey($sdkEphemPubKey)
    {
        $this->sdkEphemPubKey = $sdkEphemPubKey;
        return $this;
    }

    /**
     * @return int
     */
    public function getSdkMaxTimeout()
    {
        return $this->sdkMaxTimeout;
    }

    /**
     * @param int $sdkMaxTimeout
     *
     * @return ThreeDSecureData
     */
    public function setSdkMaxTimeout($sdkMaxTimeout)
    {
        $this->sdkMaxTimeout = $sdkMaxTimeout;
        return $this;
    }

    /**
     * @return string
     */
    public function getSdkReferenceNumber()
    {
        return $this->sdkReferenceNumber;
    }

    /**
     * @param string $sdkReferenceNumber
     *
     * @return ThreeDSecureData
     */
    public function setSdkReferenceNumber($sdkReferenceNumber)
    {
        $this->sdkReferenceNumber = $sdkReferenceNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getSdkTransID()
    {
        return $this->sdkTransID;
    }

    /**
     * @param string $sdkTransID
     *
     * @return ThreeDSecureData
     */
    public function setSdkTransID($sdkTransID)
    {
        $this->sdkTransID = $sdkTransID;
        return $this;
    }

    /**
     * @param string|null $exemptionIndicator
     *
     * @return $this
     */
    public function setExemptionIndicator($exemptionIndicator)
    {
        $this->exemptionIndicator = $exemptionIndicator;

        return $this;
    }

    /**
     * @return string
     */
    public function getExemptionIndicator()
    {
        return $this->exemptionIndicator;
    }

    /**
     * @return string
     */
    public function getCardholderAccountAgeIndicator()
    {
        return $this->cardholderAccountAgeIndicator;
    }

    /**
     * @param string $cardholderAccountAgeIndicator
     *
     * @return ThreeDSecureData
     */
    public function setCardholderAccountAgeIndicator($cardholderAccountAgeIndicator)
    {
        $this->cardholderAccountAgeIndicator = $cardholderAccountAgeIndicator;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddressLine3()
    {
        return $this->billingAddressLine3;
    }

    /**
     * @param string $billingAddressLine3
     *
     * @return ThreeDSecureData
     */
    public function setBillingAddressLine3($billingAddressLine3)
    {
        $this->billingAddressLine3 = $billingAddressLine3;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAddressLine3()
    {
        return $this->shippingAddressLine3;
    }

    /**
     * @param string $shippingAddressLine3
     *
     * @return ThreeDSecureData
     */
    public function setShippingAddressLine3($shippingAddressLine3)
    {
        $this->shippingAddressLine3 = $shippingAddressLine3;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddressState()
    {
        return $this->billingAddressState;
    }

    /**
     * @param string $billingAddressState
     *
     * @return ThreeDSecureData
     */
    public function setBillingAddressState($billingAddressState)
    {
        $this->billingAddressState = $billingAddressState;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAddressState()
    {
        return $this->shippingAddressState;
    }

    /**
     * @param string $shippingAddressState
     *
     * @return ThreeDSecureData
     */
    public function setShippingAddressState($shippingAddressState)
    {
        $this->shippingAddressState = $shippingAddressState;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowserPlatform()
    {
        return $this->browserPlatform;
    }

    /**
     * @param string $browserPlatform
     *
     * @return ThreeDSecureData
     */
    public function setBrowserPlatform($browserPlatform)
    {
        $this->browserPlatform = $browserPlatform;
        return $this;
    }

}
