<?php

namespace Ixopay\Client\CustomerProfile;

use Ixopay\Client\Json\ResponseObject;

/**
 * Class UpdateProfileResponse
 *
 * @package Ixopay\Client\CustomerProfile
 *
 * @property string $profileGuid
 * @property string $customerIdentification
 * @property CustomerData $customer
 * @property array $changedFields
 */
class UpdateProfileResponse extends ResponseObject {

}