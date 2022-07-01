<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\PaymentData\DccData;

interface DccDataInterface
{
    /**
     * @param DccData $dccData
     *
     * @return $this
     */
    public function setDccData(DccData $dccData);

    /**
     * @return DccData|null
     */
    public function getDccData();
}
