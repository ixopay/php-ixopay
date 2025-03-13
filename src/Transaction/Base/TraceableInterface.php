<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Interface TraceableInterface
 *
 * @package Ixopay\Client\Transaction\Base
 */
interface TraceableInterface {
    public function getIncludeTracing(): bool;

    public function setIncludeTracing(bool $includeTracing): void;
}
