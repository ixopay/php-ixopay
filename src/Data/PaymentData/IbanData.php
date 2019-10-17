<?php

namespace Ixopay\Client\Data\PaymentData;

/**
 * Class IbanData
 *
 * @package Ixopay\Client\CustomerProfile\PaymentData
 *
 * @property string $iban
 * @property string $bic
 * @property string $mandateId
 * @property \DateTime $mandateDate
 *
 * @method string getIban()
 * @method $this setIban($value)
 * @method string getBic()
 * @method $this setBic($value)
 * @method string getMandateId()
 * @method $this setMandateId($value)
 * @method \DateTime getMandateDate()
 */
class IbanData extends PaymentData {

    /**
     * @param \DateTime|string $mandateDate
     *
     * @return IbanData
     * @throws \Exception
     */
    public function setMandateDate($mandateDate) {
        if (is_string($mandateDate)) {
            $mandateDate = new \DateTime($mandateDate);
        }
        $this->mandateDate = $mandateDate;
        return $this;
    }

}