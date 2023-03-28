<?php

namespace Ixopay\Client\Transaction\Base;

interface SurchargeInterface
{
    public function setSurchargeAmount($surchargeAmount);

    public function getSurchargeAmount();
}
