<?php

namespace Ixopay\Client\Transaction\Base;

interface IndicatorInterface
{
    /**
     * @return string
     */
    public function getTransactionIndicator();

    /**
     * @param string $transactionIndicator
     *
     * @return $this
     */
    public function setTransactionIndicator($transactionIndicator);

}
