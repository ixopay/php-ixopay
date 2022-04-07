<?php


namespace Ixopay\Client\Data\Result;

use Ixopay\Client\Transaction\Base\ArrayableInterface;

/**
 * Class ResultData
 *
 * @package Ixopay\Client\Data\Result
 */
abstract class ResultData implements ArrayableInterface {

    /**
     * @return array
     */
    abstract public function toArray();

}
