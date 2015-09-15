#Ixopay Client
==============

1. Instantiate the "Ixopay\Client\Client" with your credentials.

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
