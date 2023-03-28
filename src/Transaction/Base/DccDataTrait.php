<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\PaymentData\DccData;

trait DccDataTrait
{
    /**
     * @var bool
     */
    private $requestDcc = false;

    /**
     * @var DccData|null
     */
    private $dccData = null;

    /**
     * @param bool $requestDcc
     *
     * @return $this
     */
    public function setRequestDcc($requestDcc)
    {
        $this->requestDcc = $requestDcc;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRequestDcc()
    {
        return $this->requestDcc;
    }

    /**
     * @param DccData|null $dccData
     *
     * @return $this
     */
    public function setDccData($dccData)
    {
        $this->dccData = $dccData;

        return $this;
    }

    /**
     * @return DccData
     */
    public function getDccData()
    {
        return $this->dccData;
    }
}
