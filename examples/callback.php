<?php

use Ixopay\Client\Client;
use Ixopay\Client\Callback\Result;

require_once('../initClientAutoload.php');

$client = new Client('username', 'password', 'apiKey', 'sharedSecret');

$client->validateCallbackWithGlobals();
$callbackResult = $client->readCallback(file_get_contents('php://input'));

$myTransactionId = $callbackResult->getTransactionId();
$gatewayTransactionId = $callbackResult->getReferenceId();

if ($callbackResult->getResult() == Result::RESULT_OK) {
    //payment ok

    //finishCart();

} elseif ($callbackResult->getResult() == Result::RESULT_ERROR) {
    //payment failed, handle errors
    $errors = $callbackResult->getErrors();

}

echo "OK";
die;