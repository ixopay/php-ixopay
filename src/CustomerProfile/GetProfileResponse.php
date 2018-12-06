<?php

namespace Ixopay\Client\CustomerProfile;

use Ixopay\Client\Json\ResponseObject;

/**
 * Class GetProfileResponse
 *
 * @package Ixopay\Client\CustomerProfile
 *
 * @property bool $profileExists
 * @property string $profileGuid
 * @property string $customerIdentification
 * @property string $preferredMethod
 * @property CustomerData $customer
 * @property PaymentInstrument[] $paymentInstruments
 */
class GetProfileResponse extends ResponseObject {

}