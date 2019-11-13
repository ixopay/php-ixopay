<?php

// include the autoloader
require_once('path/to/vendor/autoload.php');

use Ixopay\Client\Client;

// instantiate the "Ixopay\Client\Client" with your credentials
$client = new Client("username", "password", "apiKey", "sharedSecret");

// define parameters if required by the connector
$parameters = ['param1' => 'someValue'];

// retrieve options
$result = $client->getOptions('options_identifier_here', $parameters);

// handle result
if($result->isSuccess()){
    // $result->getOptions()
} else{
    // $result->getErrorMessage()
}