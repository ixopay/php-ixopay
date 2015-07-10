<?php

namespace Ixopay\Client\Data;

/**
 * Class Request
 *
 * @package Ixopay\Client\Data
 */
class Request {

    /**
     * @var array
     */
    protected $post;

    /**
     * @var array
     */
    protected $get;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @param array  $getParams
     * @param array  $postParams
     * @param string $requestBody
     * @param array  $requestHeaders
     */
    public function __construct($getParams, $postParams, $requestBody, $requestHeaders) {
        $this->post = $postParams;
        $this->get = $getParams;
        $this->body = $requestBody;
        $this->headers = $requestHeaders;
    }

    /**
     * @return Callback
     */
    public static function createFromGlobals() {

        // With the php's bug #66606, the php's built-in web server
        // stores the Content-Type and Content-Length header values in
        // HTTP_CONTENT_TYPE and HTTP_CONTENT_LENGTH fields.
        $server = $_SERVER;
        if ('cli-server' === php_sapi_name()) {
            if (array_key_exists('HTTP_CONTENT_LENGTH', $_SERVER)) {
                $server['CONTENT_LENGTH'] = $_SERVER['HTTP_CONTENT_LENGTH'];
            }
            if (array_key_exists('HTTP_CONTENT_TYPE', $_SERVER)) {
                $server['CONTENT_TYPE'] = $_SERVER['HTTP_CONTENT_TYPE'];
            }
        }

        $body = file_get_contents('php://input');

        return new self($_GET, $_POST, $body, $server);
    }

    /**
     * @return array
     */
    public function getPost() {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getGet() {
        return $this->get;
    }

    /**
     * @return string
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }
}