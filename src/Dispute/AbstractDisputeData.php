<?php

namespace Ixopay\Client\Dispute;

class AbstractDisputeData
{
    /**
     * The Uuid of referenced Dispute
     * @var string
     */
    private $uuid;

    /**
     * @var array
     */
    private $extraData = [];

    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;

        return $this;
    }

    public function getExtraData()
    {
        return $this->extraData;
    }
}
