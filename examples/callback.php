<?php

// include the autoloader
require_once('path/to/vendor/autoload.php');

use Ixopay\Client\Client;
use Ixopay\Client\Callback\Result;

// instantiate the "Ixopay\Client\Client" with your credentials
$client = new Client('username', 'password', 'apiKey', 'sharedSecret');

// check if the callback is valid
$valid = $client->validateCallbackWithGlobals();

if($valid){

    // read callback data
    $callbackResult = $client->readCallback(file_get_contents('php://input'));

} else{

    // invalid callback, ignore
    die;

}

// handle callback data
$myTransactionId = $callbackResult->getMerchantTransactionId();
$gatewayTransactionId = $callbackResult->getUuid();

if ($status === Result::RESULT_OK) {

    // payment ok
    // finishCart();

} elseif ($status === Result::RESULT_ERROR) {

    //payment failed, handle errors
    // $callbackResult->getErrorMessage();
    // $callbackResult->getErrorCode();
    // $callbackResult->getAdapterMessage();
    // $callbackResult->getAdapterCode();

}

// confirm callback with body "OK"
echo "OK";

die;