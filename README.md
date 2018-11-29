#Ixopay Client
==============

A PSR-4 autoloader is required.

We recommend to use composer, which generates a autoloader file for you (https://getcomposer.org/doc/01-basic-usage.md#autoloading).

1.) If you do not already use composer in your project directory, initialize it in your shell/ terminal:
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


```
$client = new Client("username", "password", "apiKey", "sharedSecret");

$customer = new Customer();
$customer->setBillingCountry("AT")
	->setEmail("customer@email.test");

$debit->setTransactionId("uniqueTransactionReference")
	->setSuccessUrl($redirectUrl)
	->setCancelUrl($redirectUrl)
	->setCallbackUrl($callbackUrl)
	->setAmount(10.00)
	->setCurrency('EUR')
	->setCustomer($customer);

$result = $client->debit($debit);

if ($result->isSuccess()) {
	//act depending on $result->getReturnType()
}

```
