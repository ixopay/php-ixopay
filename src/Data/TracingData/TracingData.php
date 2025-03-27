<?php

namespace Ixopay\Client\Data\TracingData;

use Ixopay\Client\Json\DataObject;

/**
 * Class TracingData
 *
 * @package Ixopay\Client\Data\TracingData
 */
class TracingData extends DataObject
{
    /** @var TracingDataTransaction[] */
    protected $transactions;

    /** @return TracingDataTransaction[] */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /** @param TracingDataTransaction[] $transactions */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
        return $this;
    }
}
