<?php

namespace Ixopay\Client\Data\TracingData;

use Ixopay\Client\Json\DataObject;

/**
 * Class TracingDataTransaction
 *
 * @package Ixopay\Client\Data\TracingData
 */
class TracingDataTransaction extends DataObject
{
    /** @var string */
    protected $uuid;

    /** @var int */
    protected $sequenceNumber;

    /** @var string */
    protected $status;

    /** @var TracingDataConnector */
    protected $connector;

    /** @return string */
    public function getUuid()
    {
        return $this->uuid;
    }

    /** @param string $uuid */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /** @return int */
    public function getSequenceNumber()
    {
        return $this->sequenceNumber;
    }

    /** @param int $sequenceNumber */
    public function setSequenceNumber($sequenceNumber)
    {
        $this->sequenceNumber = $sequenceNumber;
        return $this;
    }

    /** @return string */
    public function getStatus()
    {
        return $this->status;
    }

    /** @param string $status */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /** @return TracingDataConnector */
    public function getConnector()
    {
        return $this->connector;
    }

    /** @param TracingDataConnector $connector */
    public function setConnector($connector)
    {
        $this->connector = $connector;
        return $this;
    }
}
