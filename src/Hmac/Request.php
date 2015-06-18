<?php


namespace Ixopay\Client\Hmac;


use Acquia\Hmac\Request\RequestInterface;

class Request implements RequestInterface {
    /**
     * @param string $header
     *
     * @return bool
     */
    public function hasHeader($header) {
        // TODO: Implement hasHeader() method.
    }

    /**
     * @param string $header
     *
     * @return string
     */
    public function getHeader($header) {
        // TODO: Implement getHeader() method.
    }

    /**
     * Returns the HTTP method.
     *
     * @return string
     */
    public function getMethod() {
        // TODO: Implement getMethod() method.
    }

    /**
     * Returns the raw request body.
     *
     * @return string
     */
    public function getBody() {
        // TODO: Implement getBody() method.
    }

    /**
     * Returns the resource, which is the path + query string + fragment of the request.
     *
     * @return string
     */
    public function getResource() {
        // TODO: Implement getResource() method.
    }


}