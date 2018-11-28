<?php

namespace Ixopay\Client\Schedule;

/**
 * Class ScheduleError
 *
 * @package Ixopay\Client\Schedule
 */
class ScheduleError {

    //general errors
    const REQUEST_FAILED = 1000;
    const INVALID_RESPONSE = 1001;
    const INVALID_REQUEST_DATA = 1002;
    const PROCESSING_ERROR = 1003;
    const INVALID_SIGNATURE = 1004;
    const INVALID_XML = 1005;
    const LOGICAL_ERROR = 1006;
    const INVALID_CONFIGURATION = 1007;
    const UNEXPECTED_SYSTEM_ERROR = 1008;
    const NOT_ALLOWED = 3002;
    const UNKNOWN = 9999;

    //schedule errors

    /** schedule request is invalid */
    const INVALID_SCHEDULE_REQUEST = 7001;

    /** schedule request failed */
    const SCHEDULE_REQUEST_FAILED = 7002;

    /** Schedule not enabled for the connector */
    const SCHEDULE_NOT_ENABLED = 7003;

    /** scheduleAction is not valid */
    const INVALID_SCHEDULE_ACTION = 7005;

    /** registrationId is required */
    const REGISTER_REFERENCE_TRANSACTION_ID_REQUIRED = 7010;

    /** registrationId is not valid */
    const REGISTER_REFERENCE_TRANSACTION_ID_INVALID = 7020;

    /** The registrationId must point to a register or a debit-with-register or a preauthorize-with-register */
    const REFERENCE_TRANSACTION_IS_NOT_A_REGISTER = 7030;

    /** The transaction for starting a schedule must be a register, a debit-with-register or a preauthorize-with-register */
    const INITIAL_TRANSACTION_IS_NOT_A_REGISTER = 7035;

    /** The period between the initial and second transaction must be greater than 24 hours */
    const INVALID_PERIOD_FROM_INTIAL_TO_SECOND_TRANSACTION = 7036;

    /** The referenced transaction is already de-registered and cannot be used for a schedule  */
    const INITIAL_TRANSACTION_IS_ALREADY_DEREGISTERED = 7037;

    /** The scheduleId is not valid or does not match to the connector */
    const INVALID_SCHEDULE_ID = 7040;

    /** The startDateTime is invalid or older than 24 hours */
    const INVALID_START_DATE_TIME = 7050;

    /** The continueDateTime is invalid or older than 24 hours */
    const INVALID_CONTINUE_DATE_TIME = 7060;

    /** The status of the schedule is not valid for the requested operation */
    const INVALID_STATUS_FOR_OPERATION = 7070;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $code;

    /**
     * @param string $message
     * @param int|null $code
     * @param string|null $adapterMessage
     * @param string|null $adapterCode
     */
    public function __construct($message, $code = null) {
        $this->message = $message;
        $this->code = $code ?: self::UNKNOWN;
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

}