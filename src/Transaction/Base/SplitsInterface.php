<?php

namespace Ixopay\Client\Transaction\Base;
use Ixopay\Client\Data\Split;

/**
 * Interface SplitsInterface
 *
 * @package Ixopay\Client\Transaction\Base
 */
interface SplitsInterface {

    /**
     * @param Split[] $splits
     * @return void
     */
    public function setSplits($splits);

    /**
     * @return Split[]
     */
    public function getSplits();

    /**
     * @param Split $split
     * @return void
     */
    public function addSplit($split);

}