<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Schedule\Schedule;

/**
 * Trait ScheduleTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait ScheduleTrait {

    /**
     * @var Schedule
     */
    protected $schedule;

    /**
     * @return Schedule|null
     */
    public function getSchedule() {
        return $this->schedule;
    }

    /**
     * @param Schedule|null $schedule
     *
     * @return $this
     */
    public function setSchedule(Schedule $schedule = null) {
        $this->schedule = $schedule;

        return $this;
    }

}