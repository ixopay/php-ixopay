<?php

namespace Ixopay\Client\Transaction\Base;

trait SurchargeTrait
{
    private $surchargeAmount;

    public function setSurchargeAmount($surchargeAmount)
    {
        $this->surchargeAmount = $surchargeAmount;
    }

    public function getSurchargeAmount()
    {
        return $this->surchargeAmount;
    }
}
