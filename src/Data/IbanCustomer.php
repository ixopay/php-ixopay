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
}