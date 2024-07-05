<?php

namespace Ixopay\Client\Transaction\Base;

trait IndicatorTrait
{
    /**
     * @var string
     */
    protected $transactionIndicator;

    /**
     * @var string
     */
    private $industryPractice;

    /**
     * @return string
     */
    public function getTransactionIndicator()
    {
        return $this->transactionIndicator;
    }

    /**
     * @param string $transactionIndicator
     */
    public function setTransactionIndicator($transactionIndicator)
    {
        $this->transactionIndicator = $transactionIndicator;

        return $this;
    }

    /**
     * Get the industry practice indicator.
     *
     * @return string|null
     */
    public function getIndustryPractice()
    {
        return $this->industryPractice;
    }

    /**
     * Set the industry practice indicator.
     *
     * @param string|null $industryPractice
     * @return void
     */
    public function setIndustryPractice( $industryPractice)
    {
        $this->industryPractice = $industryPractice;
    }
}
