<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Class OffsiteTrait
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @param string $successUrl
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * @param string $cancelUrl
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorUrl()
    {
        return $this->errorUrl;
    }

    /**
     * @param string $errorUrl
     */
    public function setErrorUrl($errorUrl)
    {
        $this->errorUrl = $errorUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }



}