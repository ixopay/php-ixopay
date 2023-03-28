
# IXOPAY PHP SDK

<!-- shields -->
[![Packagist][packagist-shield]][packagist-url]
[![PHP Version][php-shield]][packagist-url]
[![License][license-shield]][license]

Accept payments and integrate 100+ payment methods on your PHP backend:
the [IXOPAY][ixopay] PHP SDK
provides convenient access to the [IXOPAY REST APIs][ixopay-docs-api].

<details>
  <summary>Table of Contents</summary>

<!-- TOC -->
- [IXOPAY PHP SDK](#ixopay-php-sdk)
  - [Installation](#installation)
    - [Requirements](#requirements)
    - [Composer](#composer)
  - [Documentation](#documentation)
  - [Usage](#usage)
    - [Prerequisites](#prerequisites)
    - [Setting up credentials](#setting-up-credentials)
    - [Process a debit transaction](#process-a-debit-transaction)
  - [Support](#support)
  - [Licence](#licence)
  - [See also](#see-also)
<!-- TOC -->

</details>

## Installation

### Requirements

- PHP 5.6 or newer
- Installed [Composer][composer]

### Composer

Add the IXOPAY PHP SDK to your `composer.json`.

```bash
composer require ixopay/ixopay-php-client
```

## Documentation

Please see [IXOPAY Gateway Documentation][ixopay-docs-gateway] for general
information about how to use the transaction processing API.

See the [IXOPAY API Reference][ixopay-docs-api] for a reference of all
transaction processing API calls.

## Usage

### Prerequisites

- [IXOPAY][ixopay] account
- API User - consisting of:
  - username, and
  - password
- Connector - consisting of:
  - API key, and
  - optional: shared secret

### Setting up credentials

Instantiate a new `Ixopay\Client\Client` authenticated via your API user & password,
connecting it to a payment adapter identified by an API key and authenticated using a shared secret.

```php
<?php

use Ixopay\Client\Client;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Result;

// Include the autoloader (if not already done via Composer autoloader)
require_once('path/to/initClientAutoload.php');

// Instantiate the "Ixopay\Client\Client" with your credentials
$api_user = "your_username";
$api_password = "your_username";
$connector_api_key = "your_chosen_connector_api_key";
$connector_shared_secret = "your_generated_connector_shared_secret";
$client = new Client($api_user, $api_password, $connector_api_key, $connector_shared_secret);
```

### Process a debit transaction

Once you instantiated a [client with credentials](#setting-up-credentials),
you can use the instance to make transaction API calls.

```php
// define your transaction ID: e.g. 'myId-'.date('Y-m-d').'-'.uniqid()
$merchantTransactionId = 'your_transaction_id'; // must be unique

$customer = new Customer()
$customer = $customer
    ->setBillingCountry("AT")
    ->setEmail("customer@example.org");

// after the payment flow the user is redirected to the $redirectUrl
$redirectUrl = 'https://example.org/success';
// all payment state changes trigger the $callbackUrl hook
$callbackUrl = 'https://api.example.org/payment-callback';

$debit = new Debit();
$debit = $debit->setTransactionId($merchantTransactionId)
    ->setSuccessUrl($redirectUrl)
    ->setCancelUrl($redirectUrl)
    ->setCallbackUrl($callbackUrl)
    ->setAmount(10.00)
    ->setCurrency('EUR')
    ->setCustomer($customer);

// send the transaction
$result = $client->debit($debit);

// now handle the result
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

?>
```

## Support

If you have suggestions for new features, spotted a bug, or encountered a
technical problem, [create an issue here][repo-new-issue].
Also, you can always contact IXOPAY's Support Team as defined in your contract.

## Licence

This repository is available under the [MIT License][license].

## See also

- [Documentation][ixopay-docs-gateway]
- [API Reference][ixopay-docs-api]

<!-- references -->
[license]: LICENSE.md
[ixopay]: https://ixopay.com
[ixopay-docs-api]: https://gateway.ixopay.com/documentation/apiv3
[ixopay-docs-gateway]: https://gateway.ixopay.com/documentation/gateway
[repo-new-issue]: https://github.com/ixopay/php-ixopay/issues/new/choose
[packagist-shield]: https://img.shields.io/packagist/v/ixopay/ixopay-php-client.svg
[packagist-url]: https://packagist.org/packages/ixopay/ixopay-php-client
[php-shield]: https://img.shields.io/packagist/php-v/ixopay/ixopay-php-client.svg
[license-shield]: https://img.shields.io/github/license/ixopay/php-ixopay.svg
[composer]: https://getcomposer.org
