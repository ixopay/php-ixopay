<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Schedule\ScheduleData;
use Ixopay\Client\Schedule\ScheduleWithTransaction;

interface ScheduleInterface {

    /**
     * @return ScheduleData|ScheduleWithTransaction
     */
    public function getSchedule();

    /**
     * @param ScheduleData|ScheduleWithTransaction $schedule |null
     *
     * @return $this
     */
    public function setSchedule($schedule = null);
}