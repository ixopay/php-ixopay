<?php

namespace Ixopay\Client\Schedule;

use Ixopay\Client\Exception\TypeException;
use Ixopay\Client\Transaction\Base\AmountableInterface;

/**
 * Class ScheduleWithTransaction
 * use to start a schedule with a transaction
 *
 * @package Ixopay\Client\Data
 */
class ScheduleWithTransaction implements AmountableInterface {

    const PERIOD_UNIT_DAY = 'DAY';
    const PERIOD_UNIT_WEEK = 'WEEK';
    const PERIOD_UNIT_MONTH = 'MONTH';
    const PERIOD_UNIT_YEAR = 'YEAR';

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $periodLength;

    /**
     * @var string
     */
    protected $periodUnit;

    /**
     * @var null|\DateTime
     */
    protected $startDateTime;

    /**
     * @var string
     */
    protected $merchantMetaData;

    /**
     * @var string|null
     */
    protected $callbackUrl = null;

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeriodLength()
    {
        return $this->periodLength;
    }

    /**
     * @param int $periodLength
     *
     * @return $this
     */
    public function setPeriodLength($periodLength)
    {
        $this->periodLength = $periodLength;
        return $this;
    }

    /**
     * @return string
     */
    public function getPeriodUnit()
    {
        return $this->periodUnit;
    }

    /**
     * @param string $periodUnit
     *
     * @return $this
     * @throws TypeException
     */
    public function setPeriodUnit($periodUnit)
    {
        if(in_array($periodUnit, self::getValidPeriodUnits())){
            $this->periodUnit = $periodUnit;
            return $this;
        }

        throw new TypeException('periodUnit for ScheduleWithTransaction is invalid');
    }

    /**
     * @return \DateTime|null
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * @return string|null
     */
    public function getStartDateTimeFormatted($format = null)
    {
        return $this->startDateTime ? $this->startDateTime->format($format ?: 'c') : null; //ISO 8601
    }

    /**
     * @param string|\DateTime $startDateTime
     *
     * @return $this
     * @throws \Exception
     */
    public function setStartDateTime($startDateTime)
    {
        if (!empty($startDateTime) && is_string($startDateTime)) {
            $startDateTime = new \DateTime($startDateTime);
        }
        $this->startDateTime = $startDateTime;
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
     * @return $this
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
     * @return ScheduleWithTransaction
     */
    public function setCallbackUrl($callbackUrl) {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

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

}
