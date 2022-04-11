<?php

namespace Ixopay\Client\Data\PaymentData;

/**
 * Class IbanData
 *
 * @package Ixopay\Client\CustomerProfile\PaymentData
 */
class IbanData extends PaymentData {

    /**
     * @var string
     */
    protected $iban;

    /**
     * @var string
     */
    protected $bic;

    /**
     * @var string
     */
    protected $mandateId;

    /**
     * @var \DateTime
     */
    protected $mandateDate;

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     *
     * @return IbanData
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     *
     * @return IbanData
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
        return $this;
    }

    /**
     * @return string
     */
    public function getMandateId()
    {
        return $this->mandateId;
    }

    /**
     * @param string $mandateId
     *
     * @return IbanData
     */
    public function setMandateId($mandateId)
    {
        $this->mandateId = $mandateId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMandateDate()
    {
        return $this->mandateDate;
    }

    /**
     * @return string|null
     */
    public function getMandateDateFormatted()
    {
        return $this->mandateDate ? $this->mandateDate->format('Y-m-d') : null;
    }

    /**
     * @param \DateTime|string $mandateDate
     *
     * @return IbanData
     * @throws \Exception
     */
    public function setMandateDate($mandateDate) {
        if (!empty($mandateDate) && is_string($mandateDate)) {
            $mandateDate = new \DateTime($mandateDate);
        }
        $this->mandateDate = $mandateDate;
        return $this;
    }

}