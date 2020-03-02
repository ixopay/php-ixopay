<?php

namespace Ixopay\Client\Schedule;

/**
 * Class StartSchedule
 *
 * @package Ixopay\Client\Data
 *
 */
class ContinueSchedule {

    /**
     * reference UUID of initial register
     *
     * @var string
     */
    protected $scheduleId;

    /**
     * @var \DateTime
     */
    protected $continueDateTime;

    /**
     * @return string
     */
    public function getScheduleId()
    {
        return $this->scheduleId;
    }

    /**
     * @param string $scheduleId
     *
     * @return ContinueSchedule
     */
    public function setScheduleId($scheduleId)
    {
        $this->scheduleId = $scheduleId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getContinueDateTime()
    {
        return $this->continueDateTime;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getContinueDateTimeFormatted($format = null)
    {
        return $this->continueDateTime ? $this->continueDateTime->format($format ? $format : 'Y-m-d H:i:s T') : null;
    }

    /**
     * @param \DateTime|string $continueDateTime
     *
     * @return ContinueSchedule
     * @throws \Exception
     */
    public function setContinueDateTime($continueDateTime)
    {
        if (!empty($continueDateTime) && is_string($continueDateTime)) {
            $continueDateTime = new \DateTime($continueDateTime);
        }
        $this->continueDateTime = $continueDateTime;
        return $this;
    }

}