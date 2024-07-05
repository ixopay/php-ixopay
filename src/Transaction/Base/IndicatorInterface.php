<?php

namespace Ixopay\Client\Transaction\Base;

interface IndicatorInterface
{
    /**
     * @return string
     */
    public function getTransactionIndicator();

    /**
     * @param string $transactionIndicator
     *
     * @return $this
     */
    public function setTransactionIndicator($transactionIndicator);


    /**
     * Get the industry practice indicator.
     *
     * @return string|null
     */
    public function getIndustryPractice();

    /**
     * Set the industry practice indicator.
     *
     * @param string|null $industryPractice
     * @return $this
     */
    public function setIndustryPractice( $industryPractice);
}
