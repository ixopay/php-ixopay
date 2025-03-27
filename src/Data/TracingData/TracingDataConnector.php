<?php

namespace Ixopay\Client\Data\TracingData;

use Ixopay\Client\Json\DataObject;

/**
 * Class TracingData
 *
 * @package Ixopay\Client\Data\TracingData
 */
class TracingDataConnector extends DataObject
{
    /** @var string */
    protected $guid;

    /** @return string */
    public function getGuid()
    {
        return $this->guid;
    }

    /** @param string $guid */
    public function setGuid($guid)
    {
        $this->guid = $guid;
        return $this;
    }
}
