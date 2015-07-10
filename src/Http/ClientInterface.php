<?php


namespace Ixopay\Client\Http;

/**
 * Interface ClientInterface
 *
 * @package Ixopay\Client\Http
 */
interface ClientInterface {

    /**
     * @param string $method
     * @param string $url
     * @param array  $headers
     *
     * @return ResponseInterface
     */
    public function send($method, $url, array $headers = array());

    /**
     * @param string $url
     * @param array  $headers
     *
     * @return ResponseInterface
     */
    public function get($url, array $headers = array());

    /**
     * @param string $url
     * @param mixed  $body
     * @param array  $headers
     *
     * @return ResponseInterface
     */
    public function post($url, $body, array $headers = array());

}