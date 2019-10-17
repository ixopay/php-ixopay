<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\PaymentData\PaymentData;

/**
 * Class PaymentDataTrait
 *
 * @package Ixopay\Client\Transaction\Base
 */
trait PaymentDataTrait {

    /** @var PaymentData  */
    protected $paymentData;

    /**
     * @return PaymentData
     */
    public function getPaymentData()
    {
        return $this->paymentData;
    }

    /**
     * @param PaymentData $paymentData
     * @return $this
     */
    public function setPaymentData($paymentData)
    {
        $this->paymentData = $paymentData;
        return $this;
    }


}