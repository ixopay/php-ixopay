<?php

namespace Ixopay\Client\Data\Result;


/**
 * Class ScheduleResultData
 * schedule data received from the gateway
 *
 * @package Ixopay\Client\Data
 */
class ScheduleResultData extends ResultData {

    /**
     * @var string
     */
    protected $scheduleId;

    /**
     * @var string
     */
    protected $scheduleStatus;

    /**
     * @var \DateTime
     */
    protected $scheduledAt;

    /**
     * @var string
     */
    protected $merchantMetaData;

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
     * @return ScheduleResultData
     */
    public function setScheduleId($scheduleId)
    {
        $this->scheduleId = $scheduleId;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheduleStatus()
    {
        return $this->scheduleStatus;
    }

    /**
     * @param string $scheduleStatus
     *
     * @return ScheduleResultData
     */
    public function setScheduleStatus($scheduleStatus)
    {
        $this->scheduleStatus = $scheduleStatus;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getScheduledAt()
    {
        return $this->scheduledAt;
    }

    /**
     * @param \DateTime|string $scheduledAt
     *
     * @return ScheduleResultData
     * @throws \Exception
     */
    public function setScheduledAt($scheduledAt)
    {
        if (!empty($scheduledAt) && is_string($scheduledAt)) {
            $scheduledAt = new \DateTime($scheduledAt);
        }
        $this->scheduledAt = $scheduledAt;
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
     * @return array
     */
    public function toArray() {
        return array(
            'scheduleId' => $this->getScheduleId(),
            'scheduleStatus' => $this->getScheduleStatus(),
            'scheduledAt' => $this->getScheduledAt(),
        );
    }
}