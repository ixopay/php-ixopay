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
     * @return array
     */
    public function toArray() {
        return array(
            'walletType' => $this->walletType,
            'walletOwner' => $this->walletOwner,
            'walletReferenceId' => $this->walletReferenceId
        );
    }


}