<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Class LevelTwoAndThreeDataTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait LevelTwoAndThreeDataTrait {
    /** @var array $l2l3Data  */
    protected $l2l3Data;

    /**
     * @param array $l2l3Data
     * @return void
     */
    public function setL2L3Data($l2l3Data) {
        $this->l2l3Data = $l2l3Data;
    }

    /**
     * @return array
     */
    public function getL2L3Data() {
        return $this->l2l3Data;
    }
}
