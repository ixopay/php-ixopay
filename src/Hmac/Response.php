<?php

namespace Ixopay\Client\Hmac;

use Acquia\Hmac\Request\RequestInterface;
use GuzzleHttp\Message\Request;

/**
 * Class Response
 *
 * @package Ixopay\Client\Hmac
 */
class Response implements RequestInterface {

    /**
     * @var \GuzzleHttp\Message\Response
     */
    protected $response;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param \GuzzleHttp\Message\Response $response
     */
    function __construct($request, $response) {
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * @param string $header
     *
     * @return bool
     */
    public function hasHeader($header) {
        return $this->response->hasHeader($header);
    }

    /**
     * @param string $header
     *
     * @return string
     */
    public function getHeader($header) {
        return $this->response->getHeader($header);
    }

    /**
     * Returns the HTTP method.
     *
     * @return string
     */
    public function getMethod() {
        return $this->request->getMethod();
    }

    /**
     * Returns the raw request body.
     *
     * @return string
     */
    public function getBody() {
        return $this->response->getBody()->getContents();
    }

    /**
     * Returns the resource, which is the path + query string + fragment of the request.
     *
     * @return string
     */
    public function getResource() {
        return $this->request->getResource();
    }


}