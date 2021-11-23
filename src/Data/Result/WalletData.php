<?php

namespace Ixopay\Client\Data\Result;

/**
 * Class WalletData
 *
 * @package Ixopay\Client\Data
 *
 */
class WalletData extends ResultData {

    /**
     * @var string
     */
    protected $walletOwner;

    /**
     * @var string
     */
    protected $walletReferenceId;

    /**
     * @var string
     */
    protected $walletType;

    /**
     * @var string
     */
    protected $walletOwnerFirstName;

    /**
     * @var string
     */
    protected $walletOwnerLastName;

    /**
     * @var string
     */
    protected $walletOwnerCountryCode;

    /**
     * @return string
     */
    public function getWalletType() {
        return $this->walletType;
    }

    /**
     * @param string $walletType
     */
    public function setWalletType($walletType) {
        $this->walletType = $walletType;
    }

    /**
     * @return string
     */
    public function getWalletOwner() {
        return $this->walletOwner;
    }

    /**
     * @param string $walletOwner
     * @return WalletData
     */
    public function setWalletOwner($walletOwner) {
        $this->walletOwner = $walletOwner;
        return $this;
    }

    /**
     * @return string
     */
    public function getWalletReferenceId() {
        return $this->walletReferenceId;
    }

    /**
     * @param string $walletReferenceId
     * @return WalletData
     */
    public function setWalletReferenceId($walletReferenceId) {
        $this->walletReferenceId = $walletReferenceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getWalletOwnerFirstName()
    {
        return $this->walletOwnerFirstName;
    }

    /**
     * @param string $walletOwnerFirstName
     */
    public function setWalletOwnerFirstName($walletOwnerFirstName)
    {
        $this->walletOwnerFirstName = $walletOwnerFirstName;
    }

    /**
     * @return string
     */
    public function getWalletOwnerLastName()
    {
        return $this->walletOwnerLastName;
    }

    /**
     * @param string $walletOwnerLastName
     */
    public function setWalletOwnerLastName($walletOwnerLastName)
    {
        $this->walletOwnerLastName = $walletOwnerLastName;
    }

    /**
     * @return string
     */
    public function getWalletOwnerCountryCode()
    {
        return $this->walletOwnerCountryCode;
    }

    /**
     * @param string $walletOwnerCountryCode
     */
    public function setWalletOwnerCountryCode($walletOwnerCountryCode)
    {
        $this->walletOwnerCountryCode = $walletOwnerCountryCode;
    }

    /**
     * @return array
     */
    public function toArray() {
        $result = array(
            'walletType' => $this->walletType,
            'walletOwner' => $this->walletOwner,
            'walletReferenceId' => $this->walletReferenceId
        );

        if (!empty($this->walletOwnerFirstName)) {
            $result['walletOwnerFirstName'] = $this->walletOwnerFirstName;
        }

        if (!empty($this->walletOwnerLastName)) {
            $result['walletOwnerLastName'] = $this->walletOwnerLastName;
        }

        if (!empty($this->walletOwnerCountryCode)) {
            $result['walletOwnerCountryCode'] = $this->walletOwnerCountryCode;
        }

        return $result;
    }


}
