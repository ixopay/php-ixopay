<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Class OffsiteTrait
 *
 * @package Ixopay\Client\Transaction
 */
trait OffsiteTrait {

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $successUrl;

    /**
     * @var string
     */
    protected $cancelUrl;

    /**
     * @var string
     */
    protected $errorUrl;

    /**
     * @var string
     */
    protected $callbackUrl;


    /**
     * The description of the transaction.
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * The description of the transaction.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * The URL to redirect to after a successful transaction.
     *
     * @return string
     */
    public function getSuccessUrl() {
        return $this->successUrl;
    }

    /**
     * The URL to redirect to after a successful transaction.
     *
     * @param string $successUrl
     *
     * @return $this
     */
    public function setSuccessUrl($successUrl) {
        $this->successUrl = $successUrl;
        return $this;
    }

    /**
     * The URL to redirect to when the customer cancels the transaction.
     *
     * @return string
     */
    public function getCancelUrl() {
        return $this->cancelUrl;
    }

    /**
     * The URL to redirect to when the customer cancels the transaction.
     *
     * @param string $cancelUrl
     *
     * @return $this
     */
    public function setCancelUrl($cancelUrl) {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    /**
     * The URL to redirect to when an error occurs during transaction.
     *
     * @return string
     */
    public function getErrorUrl() {
        return $this->errorUrl;
    }

    /**
     * The URL to redirect to when an error occurs during transaction.
     *
     * @param string $errorUrl
     *
     * @return $this
     */
    public function setErrorUrl($errorUrl) {
        $this->errorUrl = $errorUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackUrl() {
        return $this->callbackUrl;
    }

    /**
     * The URL to send any callback during this transaction.
     *
     * @param string $callbackUrl
     *
     * @return $this
     */
    public function setCallbackUrl($callbackUrl) {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }
}