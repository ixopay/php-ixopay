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

    /**  The recurring registration was cancelled by the user externally (e.g. on the payment provider's site) */
    const ACCOUNT_CLOSED_EXTERNALLY = 2001;
    /** The user cancelled the transaction */
    const USER_CANCELLED = 2002;
    /** The transaction was declined by the payment provider */
    const TRANSACTION_DECLINED = 2003;
    /** Quota exceeded on the payment provider side */
    const QUOTA_REGULATION = 2004;

    /** The request to the payment provider is timed out. */
    const TIMEOUT = 3001;

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