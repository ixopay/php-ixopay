<?php

namespace Ixopay\Client\Transaction\Base;

interface RequestDccInterface
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
    public function isRequestDcc();
}
