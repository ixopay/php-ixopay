<?php

namespace Ixopay\Client\Transaction\Base;

interface IndustryPracticeInterface
{
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
    public function setIndustryPractice($industryPractice);
}
