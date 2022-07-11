<?php

namespace Ixopay\Client\Data\PaymentData;

class DccData
{
    /**
     * @var bool
     */
    private $requestDcc;

    /**
     * @var string|null
     */
    private $remoteIdentifier;

    /**
     * @var float|null
     */
    private $originalAmount;

    /**
     * @var string|null
     */
    private $originalCurrency;

    /**
     * @var float|null
     */
    private $convertedAmount;

    /**
     * @var string|null
     */
    private $convertedCurrency;

    /**
     * @var float|null
     */
    private $conversionRate;

    /**
     * @var float|null
     */
    private $markUp;

    /**
     * @var string|null
     */
    private $selectedCurrency;

    /**
     * @param bool $requestDcc
     *
     * @return $this
     */
    public function setRequestDcc($requestDcc)
    {
        $this->requestDcc = $requestDcc;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRequestDcc()
    {
        return $this->requestDcc;
    }

    /**
     * @param string $remoteIdentifier
     *
     * @return $this
     */
    public function setRemoteIdentifier($remoteIdentifier)
    {
        $this->remoteIdentifier = $remoteIdentifier;

        return $this;
    }

    /**
     * @return string
     */
    public function getRemoteIdentifier()
    {
        return $this->remoteIdentifier;
    }

    /**
     * @param float $originalAmount
     *
     * @return $this
     */
    public function setOriginalAmount($originalAmount)
    {
        $this->originalAmount = $originalAmount;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOriginalAmount()
    {
        return $this->originalAmount;
    }

    /**
     * @param string $originalCurrency
     *
     * @return $this
     */
    public function setOriginalCurrency($originalCurrency)
    {
        $this->originalCurrency = $originalCurrency;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalCurrency()
    {
        return $this->originalCurrency;
    }

    /**
     * @param float $convertedAmount
     *
     * @return $this
     */
    public function setConvertedAmount($convertedAmount)
    {
        $this->convertedAmount = $convertedAmount;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getConvertedAmount()
    {
        return $this->convertedAmount;
    }

    /**
     * @param string $convertedCurrency
     *
     * @return $this
     */
    public function setConvertedCurrency($convertedCurrency)
    {
        $this->convertedCurrency = $convertedCurrency;

        return $this;
    }

    /**
     * @return string
     */
    public function getConvertedCurrency()
    {
        return $this->convertedCurrency;
    }

    /**
     * @param float $conversionRate
     *
     * @return $this
     */
    public function setConversionRate($conversionRate)
    {
        $this->conversionRate = $conversionRate;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getConversionRate()
    {
        return $this->conversionRate;
    }

    /**
     * @param float|null $markUp
     *
     * @return $this
     */
    public function setMarkUp($markUp)
    {
        $this->markUp = $markUp;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getMarkUp()
    {
        return $this->markUp;
    }

    /**
     * @param string $selectedCurrency
     *
     * @return $this
     */
    public function setSelectedCurrency($selectedCurrency)
    {
        $this->selectedCurrency = $selectedCurrency;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelectedCurrency()
    {
        return $this->selectedCurrency;
    }
}
