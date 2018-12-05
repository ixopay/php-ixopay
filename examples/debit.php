<?php

use Ixopay\Client\Client;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Result;

require_once('../initClientAutoload.php');

$client = new Client('username', 'password', 'apiKey', 'sharedSecret');

$customer = new Customer();
$customer
    ->setFirstName('John')
    ->setLastName('Smith')
    ->setEmail('john@smith.com')
    ->setIpAddress('123.123.123.123');
//add further customer details if necessary

// define your transaction ID: e.g. 'myId-'.date('Y-m-d').'-'.uniqid()
$merchantTransactionId = 'your_transaction_id'; // must be unique

$debit = new Debit();
$debit->setTransactionId($merchantTransactionId)
    ->setAmount(9.99)
    ->setCurrency('EUR')
    ->setCallbackUrl('https://myhost.com/path/to/my/callbackHandler')
    ->setSuccessUrl('https://myhost.com/checkout/successPage')
    ->setErrorUrl('https://myhost.com/checkout/errorPage')
    ->setDescription('One pair of shoes')
    ->setCustomer($customer);

//if token acquired via payment.js
if (isset($token)) {
    $debit->setTransactionToken($token);
}

//for recurring transactions
if ($isRecurringTransaction) {
    $debit->setReferenceTransactionId($referenceIdFromFirstTransaction);
}

$result = $client->debit($debit);

$gatewayReferenceId = $result->getReferenceId(); //store it in your database

if ($result->getReturnType() == Result::RETURN_TYPE_ERROR) {
    //error handling
    $errors = $result->getErrors();
    //cancelCart();

} elseif ($result->getReturnType() == Result::RETURN_TYPE_REDIRECT) {
    //redirect the user
    header('Location: '.$result->getRedirectUrl());
    die;
} elseif ($result->getReturnType() == Result::RETURN_TYPE_PENDING) {
    //payment is pending, wait for callback to complete

    //setCartToPending();

} elseif ($result->getReturnType() == Result::RETURN_TYPE_FINISHED) {
    //payment is finished, update your cart/payment transaction

    //finishCart();
}
