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
     * @var bool
     */
    protected $operationSuccess;

    /**
     * @var string
     */
    protected $scheduleId;

    /**
     * referenceId or UUID from the register
     *
     * @var string
     */
    protected $registrationId;

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
     * @var ScheduleError[]
     */
    protected $errors = [];

    /**
     * @return bool
     */
    public function getOperationSuccess() {
        return $this->operationSuccess;
    }

    /**
     * @param bool $operationSuccess
     *
     * @return ScheduleResult
     */
    public function setOperationSuccess($operationSuccess) {
        $this->operationSuccess = $operationSuccess;

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
     * @return string
     */
    public function getRegistrationId() {
        return $this->registrationId;
    }

    /**
     * @param string $registrationId
     *
     * @return ScheduleResult
     */
    public function setRegistrationId($registrationId) {
        $this->registrationId = $registrationId;

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
     * @return ScheduleError[]
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors() {
        return !empty($this->errors);
    }

    /**
     * @return ScheduleError|null
     */
    public function getFirstError() {
        if (!empty($this->errors)) {
            return $this->errors[0];
        }
        return null;
    }

    /**
     * @param ScheduleError[] $errors
     *
     * @return $this
     */
    public function setErrors($errors) {
        $this->errors = $errors;
        return $this;
    }

    /**
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
}