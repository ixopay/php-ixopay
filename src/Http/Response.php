<?php

namespace Ixopay\Client\Http;

use Ixopay\Client\Http\Exception\ResponseException;

/**
 * Class Response
 *
 * @package Ixopay\Client\Http
 */
class Response implements ResponseInterface {

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var int
     */
    private $errorCode;

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @var mixed
     */
    private $body;

    /**
     * @var array
     */
    private $headers = array();

    /**
     * @param int  $statusCode
     * @param array  $headers
     * @param mixed  $body
     * @param int    $errorCode
     * @param string $errorMessage
     */
    public function __construct(
        $statusCode,
        array $headers = array(),
        $body = null,
        $errorCode = 0,
        $errorMessage = ""
    ) {
        $this->statusCode = $statusCode;
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * @param array $config
     *
     * @return mixed
     *
     * @throws ResponseException
     */
    public function json(array $config = array()) {
        $json = json_decode(
            $this->body,
            isset($config["object"]) ? (bool)!$config["object"] : true,
            512,
            isset($config["options"]) ? (int)$config["options"] : 0
        );

        $error = json_last_error();
        if ($error !== JSON_ERROR_NONE) {
            throw new ResponseException();
        }

        return $json;
    }

    /**
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * @return int
     */
    public function getErrorCode() {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage() {
        return $this->errorMessage;
    }
}