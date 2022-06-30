<?php

namespace Ixopay\Client\Transaction\Base;

trait RequestDccTrait
{
    /**
     * @var bool
     */
    private $requestDcc;

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
    public function isRequestDcc()
    {
        return $this->requestDcc;
    }
}
