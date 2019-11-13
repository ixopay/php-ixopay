<?php

namespace Ixopay\Client\Options;

/**
 *
 * @package Ixopay\Client\Options
 */
class OptionsResult {

    /**
     * @var boolean
     */
    protected $success;

    /**
     * @var array
     */
    protected $options = null;

    /**
     * @var string
     */
    protected $errorMessage = '';

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     *
     * @return OptionsResult
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return OptionsResult
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     *
     * @return OptionsResult
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}
