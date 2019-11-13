<?php

// include the autoloader
require_once('path/to/vendor/autoload.php');

use Ixopay\Client\Client;
use Ixopay\Client\StatusApi\StatusRequestData;

// instantiate the "Ixopay\Client\Client" with your credentials
$client = new Client("username", "password", "apiKey", "sharedSecret");

// create StatusRequestData
$statusData = new StatusRequestData();

// set EITHER uuid OR merchantTransactionId
$statusData->setUuid('uuid_of_transaction_here');
//$statusData->setMerchantTransactionId('merchant_transaction_id_here');

// send request
$result = $client->sendStatusRequest($statusData);

// handle result
if($result->isSuccess()){
    // $result->getUuid();
    // $result->getTransactionStatus();
    // etc
} else{
    // $result->getErrorMessage();
    // $result->getErrorCode();
}