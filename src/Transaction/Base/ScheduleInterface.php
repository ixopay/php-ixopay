<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Schedule\Schedule;

interface ScheduleInterface {

    /**
     * @return Schedule
     */
    public function getSchedule();

    /**
     * @param Schedule $schedule |null
     *
     * @return $this
     */
    public function setSchedule(Schedule $schedule = null);
}