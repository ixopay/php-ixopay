<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\Split;

/**
 * Class ItemsTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait SplitsTrait {

    /** @var Split[]  */
    protected $splits = array();

    /**
     * @param Split[] $splits
     * @return $this
     */
    public function setSplits($splits) {
        $this->splits = $splits;
        return $this;
    }

    /**
     * @return Split[]
     */
    public function getSplits() {
        return $this->splits;
    }

    /**
     * @param Split $item
     *
     * @return $this
     */
    public function addSplit($item) {
        $this->splits[] = $item;
        return $this;
    }
}