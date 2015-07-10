<?php

namespace Ixopay\Client\Http\Exception;

/**
 * Class ResponseException
 *
 * @package Ixopay\Client\Http\Exception
 */
class ResponseException extends ClientException
{
    /**
     * @var mixed
     */
    private $httpStatus;

    /**
     * @var mixed
     */
    private $response;

    /**
     * @param mixed $httpStatus
     *
     * @return ResponseException
     */
    public function setHttpStatus($httpStatus)
    {
        $this->httpStatus = $httpStatus;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    /**
     * @param mixed $response
     *
     * @return ResponseException
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'code' => $this->code,
            'message' => $this->message,
            'http-status' => $this->httpStatus,
            'response' => $this->response,
        );
    }
}