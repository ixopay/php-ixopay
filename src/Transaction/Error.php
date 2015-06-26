<?php

namespace Ixopay\Client\Transaction;

/**
 * Class Error
 * @package Ixopay\Client\Transaction
 */
class Error {

    const REQUEST_FAILED = 1000;
    const INVALID_RESPONSE = 1001;
    const INVALID_REQUEST_DATA = 1002;
    const PROCESSING_ERROR = 1003;
    const INVALID_SIGNATURE = 1004;
    const INVALID_XML = 1005;

    const ACCOUNT_CLOSED_EXTERNALLY = 2001;
    const USER_CANCELLED = 2002;
    const TRANSACTION_DECLINED = 2003;
    const QUOTA_REGULATION = 2004;

    const TIMEOUT = 3001;

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