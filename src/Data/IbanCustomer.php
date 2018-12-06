<?php

namespace Ixopay\Client\Data;


use Ixopay\Client\Exception\InvalidValueException;

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
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMandateDate() {
        return $this->mandateDate;
    }

    /**
     * @param \DateTime $mandateDate
     *
     * @throws InvalidValueException
     */
    public function setMandateDate($mandateDate) {
        if (\is_string($mandateDate)) {
            $mandateDate = \DateTime::createFromFormat('Y-m-d', $mandateDate);

            if ($mandateDate === false) {
                throw new InvalidValueException('$mandateDate has to have the format Y-m-d');
            }
        }

        $this->mandateDate = $mandateDate;
        return $this;
    }

}