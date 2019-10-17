<?php

namespace Ixopay\Client\Transaction\Base;
use Ixopay\Client\Data\PaymentData\PaymentData;

/**
 * Interface PaymentDataInterface
 *
 * @package Ixopay\Client\Transaction\Base
 */
interface PaymentDataInterface {

    /**
     * @param PaymentData $paymentData
     */
    public function setPaymentData($paymentData);

    /**
     * @return PaymentData
     */
    public function getPaymentData();

}