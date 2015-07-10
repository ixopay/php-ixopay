<?php


namespace Ixopay\Client\Http;

/**
 * Class CurlExec
 *
 * @package Ixopay\Client\Http
 */
class CurlExec {

    /**
     * @var string
     */
    private $headerString = "";

    /**
     * @var array
     */
    private $headers = array();

    /**
     * @var string
     */
    private $body;

    /**
     * @param resource $handle
     */
    public function __construct($handle) {
        $this->handle = $handle;
        curl_setopt($this->handle, CURLOPT_HEADERFUNCTION, array($this, 'readHeaders'));
        $this->reset();
    }

    /**
     * @param resource $handle
     *
     * @return CurlExec
     */
    public static function getInstance($handle) {
        return new self($handle);
    }

    /**
     * @param resource $curl
     * @param string   $headerLine
     *
     * @return int
     */
    private function readHeaders($curl, $headerLine) {
        $this->headerString .= $headerLine;
        return strlen($headerLine);
    }

    /**
     * @return $this
     */
    public function exec() {
        $this->reset();

        $this->body = curl_exec($this->handle);
        $this->headers = $this->parseHeaderMessage($this->headerString);

        return $this;
    }

    /**
     * @param string $headerMessage
     *
     * @return array
     */
    private function parseHeaderMessage($headerMessage) {

        $headers = array();

        $lines = preg_split('/(\\r?\\n)/', $headerMessage, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($lines as $line) {

            // Parse message headers
            if (strpos($line, ':')) {
                $parts = explode(':', $line, 2);
                $key = trim($parts[0]);
                $value = isset($parts[1]) ? trim($parts[1]) : '';
                if (!isset($headers[$key])) {
                    $headers[$key] = $value;
                } elseif (!is_array($headers[$key])) {
                    $headers[$key] = [$headers[$key], $value];
                } else {
                    $headers[$key][] = $value;
                }
            }

        }

        return $headers;
    }

    /**
     * set default values
     */
    private function reset() {
        $this->headerString = "";
        $this->headers = array();
        $this->body = null;
    }

    /**
     * @return mixed
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