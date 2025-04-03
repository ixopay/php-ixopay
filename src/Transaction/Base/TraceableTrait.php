<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Class TraceableTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait TraceableTrait
{
    protected bool $includeTracing = false;

    public function getIncludeTracing(): bool
    {
        return $this->includeTracing;
    }

    public function setIncludeTracing(bool $includeTracing): void
    {
        $this->includeTracing = $includeTracing;
    }
}
