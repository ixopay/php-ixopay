<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\PaymentData\DccData;

interface DccDataInterface
{
    /**
     * @param bool $requestDcc
     *
     * @return $this
     */
    public function setRequestDcc($requestDcc);

    /**
     * @return bool
     */
    public function getRequestDcc();

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
