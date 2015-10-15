<?php


namespace Ixopay\Client\Data\Result;

/**
 * Class ResultData
 *
 * @package Ixopay\Client\Data\Result
 */
abstract class ResultData {

    /**
     * @return array
     */
    abstract public function toArray();

}