<?php

namespace Ixopay\Client\Data\Result;

/**
 * Class PhoneData
 *
 * @package Ixopay\Client\Data\Result
 */
class PhoneData extends ResultData {

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
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
     * @return string
     */
    public function getOperator() {
        return $this->operator;
    }

    /**
     * @param string $operator
     */
    public function setOperator($operator) {
        $this->operator = $operator;
    }

    /**
     * @return array
     */
    public function toArray() {
        return array(
            'phoneNumber' => $this->phoneNumber,
            'operator' => $this->operator,
            'country' => $this->country
        );
    }


}