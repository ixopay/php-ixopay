<?php

namespace Ixopay\Client\Data;

/**
 * Class IbanCustomer
 *
 * @package Ixopay\Client\Data
 */
class IbanCustomer extends Customer {

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
    public function getIban() {
        return $this->iban;
    }

    /**
     * @param string $iban
     *
     * @return $this
     */
    public function setIban($iban) {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return string
     */
    public function getBic() {
        return $this->bic;
    }

    /**
     * @param string $bic
     *
     * @return $this
     */
    public function setBic($bic) {
        $this->bic = $bic;
        return $this;
    }

    /**
     * @return string
     */
    public function getMandateId() {
        return $this->mandateId;
    }

    /**
     * @param string $mandateId
     */
    public function setMandateId($mandateId) {
        $this->mandateId = $mandateId;
    }

    /**
     * @return \DateTime
     */
    public function getMandateDate() {
        return $this->mandateDate;
    }

    /**
     * @param \DateTime $mandateDate
     */
    public function setMandateDate($mandateDate) {
        $this->mandateDate = $mandateDate;
    }

}