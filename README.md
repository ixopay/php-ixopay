IXOPAY PHP Client
==============

[![Packagist](https://img.shields.io/packagist/v/ixopay/ixopay-php-client.svg)](https://packagist.org/packages/ixopay/ixopay-php-client)
[![PHP Version](https://img.shields.io/packagist/php-v/ixopay/ixopay-php-client.svg)](https://packagist.org/packages/ixopay/ixopay-php-client)
[![License](https://img.shields.io/github/license/ixopay/php-ixopay.svg)](LICENSE)

## Installation via composer:

```sh
composer require ixopay/ixopay-php-client
```

## Documentation

Learn more about IXOPAY by reading its [Documentation](https://gateway.ixopay.com/documentation)

## Usage:

```php
<?php

use Ixopay\Client\Client;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Result;

// include the autoloader
require_once('path/to/vendor/autoload.php');

// instantiate the "Ixopay\Client\Client" with your credentials
$client = new Client("username", "password", "apiKey", "sharedSecret");

// define relevant objects
$customer = new Customer();
$customer->setBillingCountry("AT")
         ->setEmail("customer@email.test");

// define your unique transaction ID, e.g. 
$merchantTransactionId = uniqid('myId', true) . '-' . date('YmdHis');

$debit = new Debit();
$debit->setTransactionId($merchantTransactionId)
	  ->setSuccessUrl($redirectUrl)
	  ->setCancelUrl($redirectUrl)
	  ->setCallbackUrl($callbackUrl)
	  ->setAmount(10.00)
	  ->setCurrency('EUR')
	  ->setCustomer($customer);

// send the transaction
$result = $client->debit($debit);

// handle the result
if ($result->isSuccess()) {

    // store the referenceUuid you receive from the gateway for future references
    $gatewayReferenceId = $result->getReferenceUuid(); 
	
    // handle result based on it's returnType    
    if ($result->getReturnType() == Result::RETURN_TYPE_ERROR) {

        // read errors on error handling
        $errors = $result->getErrors();

        // handle the error
        // e.g. cancelCart();
    
    } elseif ($result->getReturnType() == Result::RETURN_TYPE_REDIRECT) {

        // redirect the user
        header('Location: '.$result->getRedirectUrl());
        
    } elseif ($result->getReturnType() == Result::RETURN_TYPE_PENDING) {
        
        // payment is pending: wait for callback to complete
    
        // handle pending
        // e.g. setCartToPending();
    
    } elseif ($result->getReturnType() == Result::RETURN_TYPE_FINISHED) {
        
        //payment is finished, update your cart/payment transaction
        // e.g. finishCart();
    }
}
```

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
