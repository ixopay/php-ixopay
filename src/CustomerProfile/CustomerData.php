<?php

namespace Ixopay\Client\CustomerProfile;

use Ixopay\Client\Json\DataObject;

/**
 * Class CustomerData
 *
 * @package Ixopay\Client\CustomerProfile
 *
 * @property string firstName
 * @property string $lastName
 * @property \DateTime $birthDate
 * @property string $gender
 * @property string $billingAddress1
 * @property string $billingAddress2
 * @property string $billingCity
 * @property string $billingPostcode
 * @property string $billingState
 * @property string $billingCountry
 * @property string $billingPhone
 * @property string $company
 * @property string $email
 * @property string $ipAddress
 * @property string $nationalId
 * @property array $extraData
 */
class CustomerData extends DataObject {

    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';


    /**
     * @param \DateTime|string $birthDate
     */
    public function setBirthDate($birthDate) {
        if (is_string($birthDate) && $birthDate) {
            $birthDate = new \DateTime($birthDate);
        }
        $this->birthDate = $birthDate;
    }

}