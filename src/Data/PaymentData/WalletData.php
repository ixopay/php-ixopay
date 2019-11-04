<?php

namespace Ixopay\Client\Data\PaymentData;

/**
 * Class WalletData
 *
 * @package Ixopay\Client\CustomerProfile\PaymentData
 */
class WalletData extends PaymentData {

    const TYPE_PAYPAL = 'paypal';

    /** @var string */
    protected $walletReferenceId;
    /** @var string */
    protected $walletOwner;
    /** @var string */
    protected $walletType;

    /**
     * @return string
     */
    public function getWalletReferenceId()
    {
        return $this->walletReferenceId;
    }

    /**
     * @param string $walletReferenceId
     *
     * @return WalletData
     */
    public function setWalletReferenceId($walletReferenceId)
    {
        $this->walletReferenceId = $walletReferenceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getWalletOwner()
    {
        return $this->walletOwner;
    }

    /**
     * @param string $walletOwner
     *
     * @return WalletData
     */
    public function setWalletOwner($walletOwner)
    {
        $this->walletOwner = $walletOwner;
        return $this;
    }

    /**
     * @return string
     */
    public function getWalletType()
    {
        return $this->walletType;
    }

    /**
     * @param string $walletType
     *
     * @return WalletData
     */
    public function setWalletType($walletType)
    {
        $this->walletType = $walletType;
        return $this;
    }

}