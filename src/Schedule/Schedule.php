<?php

namespace Ixopay\Client\Schedule;

use Ixopay\Client\Transaction\Base\AmountableInterface;

/**
 * Class Schedule
 *
 * @package Ixopay\Client\Data
 */
class Schedule implements AmountableInterface {

    const PERIOD_UNIT_DAY = 'DAY';
    const PERIOD_UNIT_WEEK = 'WEEK';
    const PERIOD_UNIT_MONTH = 'MONTH';
    const PERIOD_UNIT_YEAR = 'YEAR';

    /**
     * reference UUID of initial register
     *
     * @var string
     */
    protected $registrationUuid;

    /**
     * @var string
     */
    protected $scheduleId;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var null|\DateTime
     */
    protected $startDateTime;

    /**
     * @var null|\DateTime
     */
    protected $continueDateTime;

    /**
     * @var int
     */
    protected $periodLength;

    /**
     * @var string
     */
    protected $periodUnit;

    /**
     * @return string[]
     */
    public static function getValidPeriodUnits() {
        return [
            self::PERIOD_UNIT_DAY,
            self::PERIOD_UNIT_WEEK,
            self::PERIOD_UNIT_MONTH,
            self::PERIOD_UNIT_YEAR
        ];
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
     * @return Schedule
     */
    public function setScheduleId($scheduleId) {
        $this->scheduleId = $scheduleId;

        return $this;
    }

    /**
     * @deprecated use getRegistrationUuid()
     * @return string
     */
    public function getRegistrationId() {
        return $this->getRegistrationUuid();
    }

    /**
     * @param string $registrationId
     *
     * @return Schedule
     * @deprecated use setRegistrationUuid()
     */
    public function setRegistrationId($registrationId) {
        $this->setRegistrationUuid($registrationId);

        return $this;
    }

    /**
     * @return string
     */
    public function getRegistrationUuid() {
        return $this->registrationUuid;
    }

    /**
     * @param string $registrationUuid
     *
     * @return Schedule
     */
    public function setRegistrationUuid($registrationUuid) {
        $this->registrationUuid = $registrationUuid;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return Schedule
     */
    public function setAmount($amount) {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return Schedule
     */
    public function setCurrency($currency) {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getStartDateTime() {
        return $this->startDateTime;
    }

    /**
     * @param null|\DateTime
     *
     * @return Schedule
     */
    public function setStartDateTime($startDateTime) {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getContinueDateTime() {
        return $this->continueDateTime;
    }

    /**
     * @param null|\DateTime
     *
     * @return Schedule
     */
    public function setContinueDateTime($continueDateTime) {
        $this->continueDateTime = $continueDateTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getPeriodLength() {
        return $this->periodLength;
    }

    /**
     * @param int $periodLength
     *
     * @return Schedule
     */
    public function setPeriodLength($periodLength) {
        $this->periodLength = $periodLength;

        return $this;
    }

    /**
     * @return string
     */
    public function getPeriodUnit() {
        return $this->periodUnit;
    }

    /**
     * @param string $periodUnit
     *
     * @return Schedule
     */
    public function setPeriodUnit($periodUnit) {
        $this->periodUnit = $periodUnit;

        return $this;
    }
}