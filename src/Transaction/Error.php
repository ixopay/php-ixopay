<?php

namespace Ixopay\Client\Transaction;

/**
 * Class Error
 * @package Ixopay\Client\Transaction
 */
class Error {

    /** The request to the payment provider failed for some reason (e.g. host not reachable) */
    const REQUEST_FAILED = 1000;
    /** The response of the adapter could not be interpreted */
    const INVALID_RESPONSE = 1001;
    /** The data you provided is not sufficient or incorrect */
    const INVALID_REQUEST_DATA = 1002;
    /** The adapter could not process the transaction */
    const PROCESSING_ERROR = 1003;
    /** The signature of the request is wrong */
    const INVALID_SIGNATURE = 1004;
    /** The provided XML is not well formatted or not acceptable */
    const INVALID_XML = 1005;
    /** There is a logical error, e.g. referenced transaction was not successful */
    const LOGICAL_ERROR = 1006;
    /** invalid configuration at payment provider */
    const INVALID_CONFIGURATION = 1007;
    /** provider has an unexpected system error */
    const UNEXPECTED_SYSTEM_ERROR = 1008;

    /**  The recurring registration was cancelled by the user externally (e.g. on the payment provider's site) */
    const ACCOUNT_CLOSED_EXTERNALLY = 2001;
    /** The user cancelled the transaction */
    const USER_CANCELLED = 2002;
    /** The transaction was declined by the payment provider */
    const TRANSACTION_DECLINED = 2003;
    /** Quota exceeded on the payment provider side */
    const QUOTA_REGULATION = 2004;
    /** The transaction expired before completing */
    const TRANSACTION_EXPIRED = 2005;
    /** Card is over limit or has not enough funds */
    const INSUFFICIENT_FUNDS = 2006;
    /** Incorrect payment information */
    const INCORRECT_PAYMENT_INFO = 2007;
    /** card is invalid */
    const INVALID_CARD = 2008;
    /** card is expired */
    const EXPIRED_CARD = 2009;
    /** card is stolen/lost/fraudulent */
    const FRAUDULENT_CARD = 2010;
    /** card type is not supported */
    const UNSUPPORTED_CARD = 2011;
    /** transaction was cancelled by the payment system */
    const TRANSACTION_CANCELLED = 2012;
    /** transaction was declined by risk check */
    const RISK_CHECK_BLOCK = 2013;
    /** card should be picked-up by merchant */
    const PICKUP_CARD = 2014;
    /** card is claimed as lost */
    const LOST_CARD = 2015;
    /** card is claimed as lost */
    const STOLEN_CARD = 2016;
    /** provided IBAN is invalid */
    const IBAN_INVALID = 2017;
    /** provided BIC is invalid */
    const BIC_INVALID = 2018;
    /** provided customer data invalid (e.g. invalid country), see error message for details */
    const CUSTOMER_DATA_INVALID = 2019;
    /** cvv code required */
    const CVV_REQUIRED = 2020;
    /** 3D-secure verification failed */
    const SECURE_3D_FAILED = 2021;

    /** The request to the payment provider is timed out. */
    const TIMEOUT = 3001;
    /** transaction not allowed */
    const NOT_ALLOWED = 3002;
    /** provider temporary unavailable */
    const TEMPORARY_UNAVAILABLE = 3003;
    /** transaction duplicate */
    const DUPLICATE_TRANSACTION_ID = 3004;
    /** communication error with the provider */
    const COMMUNICATION_ERROR = 3005;

    // schedule errors

    /** schedule request is invalid */
    const INVALID_SCHEDULE_REQUEST = 7001;

    /** schedule request failed */
    const SCHEDULE_REQUEST_FAILED = 7002;

    /** The transaction for starting a schedule must be a register, a debit-with-register or a preauthorize-with-register */
    const INITIAL_TRANSACTION_IS_NOT_A_REGISTER = 7035;

    /** The period beetween the initial and second transaction must be greater than 24 hours */
    const INVALID_PERIOD_FROM_INTIAL_TO_SECOND_TRANSACTION = 7036;

    /** The startDateTime is invalid or older than 24 hours */
    const INVALID_START_DATE_TIME = 7050;

    /*
     * results which require manual intervention
     */
    /** a previous chargeback was reverted */
    const CHARGEBACK_REVERTED = 4001;
    /** dispute on payment provider site */
    const PAYMENT_DISPUTE = 4002;

    /** An error occurred while processing the request. */
    const UNKNOWN = 9999;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $adapterCode;

    /**
     * @var string
     */
    protected $adapterMessage;

    /**
     * @param string $message
     * @param int|null $code
     * @param string|null $adapterMessage
     * @param string|null $adapterCode
     */
    public function __construct($message, $code=null, $adapterMessage=null, $adapterCode=null) {
        $this->message = $message;
        $this->code = $code ?: self::UNKNOWN;
        $this->adapterMessage = $adapterMessage;
        $this->adapterCode = $adapterCode;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getAdapterCode()
    {
        return $this->adapterCode;
    }

    /**
     * @return string
     */
    public function getAdapterMessage()
    {
        return $this->adapterMessage;
    }

}