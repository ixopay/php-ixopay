<?php

// include the autoloader
require_once('path/to/vendor/autoload.php');

use Ixopay\Client\Client;

// instantiate the "Ixopay\Client\Client" with your credentials
$client = new Client('username', 'password', 'apiKey', 'sharedSecret');

$result = $client->getCustomerProfileByIdentification('12345');
//$result = $client->getCustomerProfileByProfileGuid('GUID-12345');

// handle result

