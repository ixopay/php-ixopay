<?php

namespace Ixopay\Client\Transaction\Base;
use Ixopay\Client\Data\ThreeDSecureData;

/**
 * Interface ThreeDSecureInterface
 *
 * @package Ixopay\Client\Transaction\Base
 */
interface ThreeDSecureInterface
{
    /**
     * @return ThreeDSecureData
     */
    public function getThreeDSecureData();

    /**
     * @param ThreeDSecureData $threeDSecureData
     *
     * @return mixed
     */
    public function setThreeDSecureData($threeDSecureData);
}
