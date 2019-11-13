<?php

namespace Ixopay\Client\Schedule;

/**
 * Class Result
 *
 * @package Ixopay\Client\Data
 */
class ScheduleResult {

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_PAUSED = 'PAUSED';
    const STATUS_CANCELLED = 'CANCELLED';
    const STATUS_ERROR = 'ERROR';
    const STATUS_CREATE_PENDING = 'CREATE-PENDING'; // create process of a schedule not yet finished

    /**
     * @deprecated use $success
     *
     * @var bool
     */
    protected $operationSuccess;

    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string
     */
    protected $scheduleId;

    /**
     * @deprecated use $registrationUuid
     *
     * referenceId or UUID from the register
     *
     * @var string
     */
    protected $registrationId;

    /**
     * @var string
     */
    protected $registrationUuid;

    /**
     * @var string
     */
    protected $oldStatus;

    /**
     * @var string
     */
    protected $newStatus;

    /**
     * @var string|null - e.g. '2019-12-31 23:59:00 UTC'
     */
    protected $scheduledAt; // next scheduled payment

    /**
     * @deprecated use $errorMessage, $errorCode
     *
     * @var ScheduleError[]
     */
    protected $errors = [];

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @deprecated use isSuccess()
     * @return bool
     */
    public function getOperationSuccess() {
        return $this->success;
    }

    /**
     * @deprecated use setSuccess()
     *
     * @param bool $operationSuccess
     *
     * @return ScheduleResult
     */
    public function setOperationSuccess($operationSuccess) {
        $this->success = $operationSuccess;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     *
     * @return ScheduleResult
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegistrationUuid()
    {
        return $this->registrationUuid;
    }

    /**
     * @param string $registrationUuid
     *
     * @return ScheduleResult
     */
    public function setRegistrationUuid($registrationUuid)
    {
        $this->registrationUuid = $registrationUuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheduleId() {
        return $this->scheduleId;
    }

    /**
     * @param string $scheduleId
     *
     * @return ScheduleResult
     */
    public function setScheduleId($scheduleId) {
        $this->scheduleId = $scheduleId;

        return $this;
    }

    /**
     * @deprecated use $getRegistrationUuid
     *
     * @return string
     */
    public function getRegistrationId() {
        return $this->registrationUuid;
    }

    /**
     * @deprecated use setRegistrationUuid()
     *
     * @param string $registrationId
     *
     * @return ScheduleResult
     */
    public function setRegistrationId($registrationId) {
        $this->registrationUuid = $registrationId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOldStatus() {
        return $this->oldStatus;
    }

    /**
     * @param string $oldStatus
     *
     * @return ScheduleResult
     */
    public function setOldStatus($oldStatus) {
        $this->oldStatus = $oldStatus;

        return $this;
    }

    /**
     * @return string
     */
    public function getNewStatus() {
        return $this->newStatus;
    }

    /**
     * @param string $newStatus
     *
     * @return ScheduleResult
     */
    public function setNewStatus($newStatus) {
        $this->newStatus = $newStatus;

        return $this;
    }

    /**
     * @deprecated use getErrorMessage(), getErrorCode()
     *
     * @return ScheduleError[]
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @deprecated
     * @return bool
     */
    public function hasErrors() {
        return !empty($this->errors);
    }

    /**
     * @deprecated
     * @return ScheduleError|null
     */
    public function getFirstError() {
        if (!empty($this->errors)) {
            return $this->errors[0];
        }
        return null;
    }

    /**
     * @deprecated
     *
     * @param ScheduleError[] $errors
     *
     * @return $this
     */
    public function setErrors($errors) {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @deprecated
     *
     * @param ScheduleError $error
     *
     * @return $this
     */
    public function addError(ScheduleError $error) {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getScheduledAt() {
        return $this->scheduledAt;
    }

    /**
     * @param string|\DateTime|null $scheduledAt
     *
     * @return $this
     */
    public function setScheduledAt($scheduledAt) {

        if ($scheduledAt instanceof \DateTime) {
            $scheduledAt = $scheduledAt->format('Y-m-d H:i:s T');
        }

        $this->scheduledAt = $scheduledAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     *
     * @return ScheduleResult
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     *
     * @return ScheduleResult
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

}