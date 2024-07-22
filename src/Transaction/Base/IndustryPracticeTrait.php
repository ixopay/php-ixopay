<?php

namespace Ixopay\Client\Transaction\Base;

trait IndustryPracticeTrait
{

    /**
     * @var string
     */
    private $industryPractice;

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
    public function setIndustryPractice($industryPractice)
    {
        $this->industryPractice = $industryPractice;
    }
}
