<?php

// include the autoloader
require_once('path/to/vendor/autoload.php');

use Ixopay\Client\Client;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Result;

// instantiate the "Ixopay\Client\Client" with your credentials
$client = new Client("username", "password", "apiKey", "sharedSecret");

// define relevant objects
$customer = new Customer();
$customer->setFirstName('John')
         ->setLastName('Smith')
         ->setEmail('john@smith.com')
         ->setIpAddress('123.123.123.123');
         //add further customer details if necessary

// define your transaction ID
// must be unique! e.g.
$merchantTransactionId = $merchantTransactionId = uniqid('myId', true) . '-' . date('YmdHis');

// define transaction relevant object
$debit = new Debit();
$debit->setMerchantTransactionId($merchantTransactionId)
	  ->setSuccessUrl('http://example.com/success')
	  ->setCancelUrl('http://example.com/cancel')
	  ->setCallbackUrl('http://example.com/callback')
	  ->setAmount(10.00)
	  ->setCurrency('EUR')
	  ->setCustomer($customer);

// send the transaction
$result = $client->debit($debit);

// handle the result
if ($result->isSuccess()) {

    // store the uuid you receive from the gateway for future references
    $gatewayReferenceId = $result->getUuid();

    // handle result based on it's returnType
    if ($result->getReturnType() === Result::RETURN_TYPE_ERROR) {

        // read errors on error handling
        $errors = $result->getErrors();

        // handle the error
        // e.g. cancelCart();

    } elseif ($result->getReturnType() === Result::RETURN_TYPE_REDIRECT) {

        // redirect the user
        header('Location: '.$result->getRedirectUrl());

    } elseif ($result->getReturnType() === Result::RETURN_TYPE_PENDING) {

        // payment is pending: wait for callback to complete

        // handle pending
        // e.g. setCartToPending();

    } elseif ($result->getReturnType() === Result::RETURN_TYPE_FINISHED) {

        //payment is finished, update your cart/payment transaction
        // e.g. finishCart();
    }

} else{

    // handle error
    // $result->getErrorMessage()
    // $result->getErrorCode()
    // $result->getAdapterMessage()
    // $result->getAdapterCode()

}