<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Schedule\ScheduleData;
use Ixopay\Client\Schedule\ScheduleWithTransaction;

/**
 * Trait ScheduleTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait ScheduleTrait {

    /**
     * @var ScheduleWithTransaction
     */
    protected $schedule;

    /**
     * ScheduleResultData for backward compatibility
     *
     * @return ScheduleData|ScheduleWithTransaction
     */
    public function getSchedule() {
        return $this->schedule;
    }

    /**
     * ScheduleResultData for backward compatibility
     *
     * @param ScheduleData|ScheduleWithTransaction $schedule
     *
     * @return $this
     */
    public function setSchedule($schedule = null) {
        $this->schedule = $schedule;

        return $this;
    }

}