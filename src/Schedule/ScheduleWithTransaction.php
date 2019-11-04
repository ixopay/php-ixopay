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
    public function getStartDateTimeFormatted()
    {
        return $this->startDateTime ? $this->startDateTime->format('Y-m-d H:i:s T') : null;
    }

    /**
     * @param \DateTime|null $startDateTime
     *
     * @return $this
     */
    public function setStartDateTime($startDateTime)
    {
        $this->startDateTime = $startDateTime;
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