<?php

namespace Ixopay\Client\Data\Result;

/**
 * Represents a credit card.
 *
 * @package Ixopay\Client\Data
 */
class IbanData extends ResultData {

    /**
     * @var string
     */
    protected $accountOwner;

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
    protected $bankName;

    /**
     * @var string
     */
    protected $country;

    /**
     * @return string
     */
    public function getAccountOwner() {
        return $this->accountOwner;
    }

    /**
     * @param string $accountOwner
     */
    public function setAccountOwner($accountOwner) {
        $this->accountOwner = $accountOwner;
    }

    /**
     * @return string
     */
    public function getIban() {
        return $this->iban;
    }

    /**
     * @param string $iban
     */
    public function setIban($iban) {
        $this->iban = $iban;
    }

    /**
     * @return string
     */
    public function getBic() {
        return $this->bic;
    }

    /**
     * @param string $bic
     */
    public function setBic($bic) {
        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getBankName() {
        return $this->bankName;
    }

    /**
     * @param string $bankName
     */
    public function setBankName($bankName) {
        $this->bankName = $bankName;
    }

    /**
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country) {
        $this->country = $country;
    }

    /**
     * @return array
     */
    public function toArray() {
        return array(
            'accountOwner' => $this->getAccountOwner(),
            'iban' => $this->getIban(),
            'bic' => $this->getBic(),
            'bankName' => $this->getBankName(),
            'country' => $this->getCountry()
        );
    }
}