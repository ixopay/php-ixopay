<?php


namespace Ixopay\Client\Transaction\Base;

/**
 * Interface OffsiteInterface
 * @package Ixopay\Client\Transaction
 */
interface OffsiteInterface {

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getSuccessUrl();

    /**
     * @param string $successUrl
     */
    public function setSuccessUrl($successUrl);

    /**
     * @return string
     */
    public function getCancelUrl();

    /**
     * @param string $cancelUrl
     */
    public function setCancelUrl($cancelUrl);

    /**
     * @return string
     */
    public function getErrorUrl();

    /**
     * @param string $errorUrl
     */
    public function setErrorUrl($errorUrl);

    /**
     * @return string
     */
    public function getCallbackUrl();

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl($callbackUrl);
}