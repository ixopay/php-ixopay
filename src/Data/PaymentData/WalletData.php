<?php

namespace Ixopay\Client\Data\PaymentData;

/**
 * Class WalletData
 *
 * @package Ixopay\Client\CustomerProfile\PaymentData
 *
 * @property string $walletReferenceId
 * @property string $walletOwner
 * @property string $walletType
 *
 * @method string getWalletReferenceId()
 * @method $this setWalletReferenceId($value)
 * @method string getWalletOwner()
 * @method $this setWalletOwner($value)
 * @method string getWalletType()
 * @method $this setWalletType($value)
 */
class WalletData extends PaymentData {

    const TYPE_PAYPAL = 'paypal';

}