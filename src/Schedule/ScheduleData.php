<?php

namespace Ixopay\Client\Schedule;

use Ixopay\Client\Transaction\Base\AmountableInterface;

/**
 * Class ScheduleResultData
 *   Should be deprecated in the future as it contains properties
 *   not used by other schedule actions. Additionally it's not
 *   clear which actions require which properties.
 *
 *  - StartSchedule (obj): used to start a schedule
 *  - ContinueSchedule (obj): used to continue schedule
 *  - string [scheduleId]: used to show, pause or cancel a schedule
 *
 * @package Ixopay\Client\Data
 */
class ScheduleData implements AmountableInterface {

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
     * @var string
     */
    protected $merchantMetaData;

    /**
     * @var string|null
     */
    protected $callbackUrl = null;

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
     * @return ScheduleData
     */
    public function setScheduleId($scheduleId) {
        $this->scheduleId = $scheduleId;

        return $this;
    }

    /**
     * @deprecated use getRegistrationUuid()
     *
     * @return string
     */
    public function getRegistrationId() {
        return $this->getRegistrationUuid();
    }

    /**
     * @deprecated use setRegistrationUuid()
     *
     * @param string $registrationId
     *
     * @return ScheduleData
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
     * @return ScheduleData
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
     * @return ScheduleData
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
     * @return ScheduleData
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
     * @param string|null $format
     * @return string|null
     */
    public function getStartDateTimeFormatted($format = null) {
        return $this->startDateTime ? $this->startDateTime->format($format ? $format : 'Y-m-d H:i:s T') : null;
    }

    /**
     * @param \DateTime|string
     *
     * @return ScheduleData
     * @throws \Exception
     */
    public function setStartDateTime($startDateTime) {
        if (!empty($startDateTime) && is_string($startDateTime)) {
            $startDateTime = new \DateTime($startDateTime);
        }
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
     * @param string|null
     * @return string|null
     */
    public function getContinueDateTimeFormatted($format = null) {
        return $this->continueDateTime ? $this->continueDateTime->format($format ? $format : 'Y-m-d H:i:s T') : null;
    }

    /**
     * @param null|\DateTime
     *
     * @return ScheduleData
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
     * @return ScheduleData
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
     * @return ScheduleData
     */
    public function setPeriodUnit($periodUnit) {
        $this->periodUnit = $periodUnit;

        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantMetaData() {
        return $this->merchantMetaData;
    }

    /**
     * @param string $merchantMetaData
     * @return ScheduleData
     */
    public function setMerchantMetaData($merchantMetaData) {
        $this->merchantMetaData = $merchantMetaData;
        return $this;
    }

    /**
     * Get CallbackUrl
     *
     * @return string|null
     */
    public function getCallbackUrl() {
        return $this->callbackUrl;
    }

    /**
     * Set CallbackUrl
     *
     * @param string|null $callbackUrl
     *
     * @return ScheduleData
     */
    public function setCallbackUrl($callbackUrl) {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

}
