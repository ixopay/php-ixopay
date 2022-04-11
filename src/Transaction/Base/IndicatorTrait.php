<?php

namespace Ixopay\Client\Transaction\Base;

trait IndicatorTrait
{
    /**
     * @var string
     */
    protected $transactionIndicator;

    /**
     * @return string
     */
    public function getTransactionIndicator()
    {
        return $this->transactionIndicator;
    }

    /**
     * @param string $transactionIndicator
     */
    public function setTransactionIndicator($transactionIndicator)
    {
        $this->transactionIndicator = $transactionIndicator;

        return $this;
    }
}
