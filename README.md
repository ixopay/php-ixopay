Ixopay Client
==============

Installing via composer:
```
composer require ixolit/ixopay-php-client
```

PHP Example:
```
<?php

use Ixopay\Client\Client;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Result;

require_once('/path/to/autoload.php'); // for further instructions see description below

$client = new Client("username", "password", "apiKey", "sharedSecret");

$customer = new Customer();
$customer->setBillingCountry("AT")
	->setEmail("customer@email.test");

$debit = new Debit();

// define your transaction ID: e.g. 'myId-'.date('Y-m-d').'-'.uniqid()
$merchantTransactionId = 'your_transaction_id'; // must be unique

$debit->setTransactionId($merchantTransactionId)
	->setSuccessUrl($redirectUrl)
	->setCancelUrl($redirectUrl)
	->setCallbackUrl($callbackUrl)
	->setAmount(10.00)
	->setCurrency('EUR')
	->setCustomer($customer);

$result = $client->debit($debit);

if ($result->isSuccess()) {
	//act depending on $result->getReturnType()
	
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
}


```

### Composer and Autoloading

The PHP Client requires a PSR-4 autoloader. (https://www.php-fig.org/psr/psr-4/)

We recommend to use composer, which generates an autoloader file for you (https://getcomposer.org/doc/01-basic-usage.md#autoloading).

1.) If you do not already use composer (Install guide on: https://getcomposer.org/) in your project directory, initialize it in your shell/ terminal:
```
composer init
```

2.) In the shell install the php client in your project directory
```
composer require ixolit/ixopay-php-client
```

3.) Now in your php file require your PRS-4 autoload file:

```
require_once('/path/to/client/autoload.php'); // with composer it is something like __DIR__.'/vendor/autoload.php'
```

4.) Instantiate the "Ixopay\Client\Client" with your credentials, send the transaction and react on the result.
