<?php

namespace Ixopay\Client\Http;

use CurlHandle;
use Ixopay\Client\Client;
use Ixopay\Client\Http\Exception\ClientException;

/**
 * Class CurlClient
 *
 * @package Ixopay\Client\Http
 */
class CurlClient implements ClientInterface {

    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';

    /**
     * @var CurlHandle
     */
    private $handle;

    /**
     * @var array
     */
    private static $defaultOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_FOLLOWLOCATION => false,
    ];

    /**
     * @var string
     */
    protected $serviceName = 'Gateway';

    /**
     * @var array
     */
    protected $additionalHeaders = array();

    /**
     * @var array
     */
    protected $customHeaders = array();

    /**
     * @var array
     */
    protected $customOptions = array();

    /**
     *
     */
    public function __construct() {
        $this->handle = curl_init();
        $this->setOptionArray(self::$defaultOptions);
    }

    /**
     * @param string $serviceName
     */
    public function setServiceName($serviceName) {
        $this->serviceName = $serviceName;
    }

    /**
     * @param string $option
     * @param mixed  $value
     *
     * @return void
     */
    public static function setDefaultOption($option, $value) {
        self::$defaultOptions[$option] = $value;
    }

    /**
     * @param array $options
     *
     * @return void
     */
    public static function setDefaultOptions(array $options) {
        self::$defaultOptions = $options;
    }

    /**
     * @param string $option
     * @param mixed  $value
     *
     * @return $this
     */
    public function setOption($option, $value) {
        curl_setopt($this->handle, $option, $value);
        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptionArray(array $options) {
        curl_setopt_array($this->handle, $options);
        return $this;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return $this
     */
    public function setAuthentication($username, $password) {
        curl_setopt($this->handle, CURLOPT_USERPWD, $username . ':' . $password);
        return $this;
    }

    /**
     * @param array $customHeaders
     * @return $this
     */
    public function setCustomHeaders(array $customHeaders){
        $this->customHeaders = $customHeaders;
        return $this;
    }

    /**
     * @param array $customOptions
     * @return $this
     */
    public function setCustomCurlOptions(array $customOptions){
        $this->customOptions = $customOptions;
        return $this;
    }

    /**
     * Execute the request and return the response
     *
     * @param string $method
     * @param string $url
     * @param array  $headers
     *
     * @return mixed
     */
    public function send($method, $url, array $headers = []) {
        $this->setOption(CURLOPT_URL, $url);

        $allHeaders = array();
        foreach ($this->mergeHeaders($headers, $this->additionalHeaders) as $k => $v) {
            $allHeaders[] = $k . ': ' . $v;
        }

        if($this->customHeaders){
            foreach ($this->mergeHeaders($headers, $this->customHeaders) as $k => $v) {
                $allHeaders[] = $k . ': ' . $v;
            }
        }
        $allHeaders[] = 'X-SDK-Type: Gateway PHP Client';
        $allHeaders[] = 'X-SDK-Version: '.Client::VERSION;
        if (phpversion()) {
            $allHeaders[] = 'X-SDK-PlatformVersion: ' . phpversion();
        }

        $this->setOption(CURLOPT_HTTPHEADER, $allHeaders);

        if($this->customOptions){
            $this->setOptionArray($this->customOptions);
        }

        $exec = CurlExec::getInstance($this->handle)->exec();

        $response = new Response(
            $this->getResponseCode(),
            $exec->getHeaders(),
            $exec->getBody(),
            $this->getErrno(),
            $this->getError()
        );

        return $response;

    }

    /**
     * @param string $url
     * @param array  $headers
     *
     * @return mixed
     */
    public function get($url, array $headers = []) {
        return $this->send(self::METHOD_GET, $url, $headers);
    }

    /**
     * @param string       $url
     * @param string|array $body
     * @param array        $headers
     *
     * @return Response
     * @throws ClientException
     */
    public function post($url, $body, array $headers = [], $buildQuery = true) {

        if ($body && is_string($body)) {
            $this->setOption(CURLOPT_CUSTOMREQUEST, "POST");
            $this->setOption(CURLOPT_POSTFIELDS, $body);
        } elseif ($body && is_array($body)) {
            $this->setOption(CURLOPT_POST, 1);
            $this->setOption(CURLOPT_POSTFIELDS, ($buildQuery) ? http_build_query($body) : $body);
        } else {
            throw new ClientException('invalid body datatype allowed: string and array');
        }

        return $this->send(self::METHOD_POST, $url, $headers);
    }

    /**
     * @param string       $url
     * @param string|array $body
     * @param array        $headers
     *
     * @return mixed
     * @throws ClientException
     */
    public function put($url, $body, array $headers = []) {
        if (is_string($body)) {
            $this->setOption(CURLOPT_CUSTOMREQUEST, "PUT");
            $this->setOption(CURLOPT_POSTFIELDS, $body);
        } elseif ($body && is_array($body)) {
            $this->setOption(CURLOPT_CUSTOMREQUEST, "PUT");
            $this->setOption(CURLOPT_POSTFIELDS, http_build_query($body));
        } else {
            throw new ClientException('invalid body datatype allowed: string and array');
        }

        return $this->send(self::METHOD_PUT, $url, $headers);
    }

    /**
     * @param int $apiId
     * @param string $sharedSecret
     * @param string $url
     * @param string $body
     * @param array $headers
     * @param bool $rfcCompliantTimezone
     * @return $this
     * @throws \Exception
     */
    public function sign($apiId, $sharedSecret, $url, $body, $headers = array(), $rfcCompliantTimezone = false, $newAlgo = false)
    {
        $contentType = 'text/xml; charset=utf-8';

        $data = $this->getSignRequestData(
            $url,
            $sharedSecret,
            'POST',
            $body,
            $contentType,
            $rfcCompliantTimezone,
            $newAlgo
        );

        $signature = $data['signature'];

        $authHeader = $this->serviceName . ' ' . $apiId . ':' . $signature;

        $this->additionalHeaders = [
            'Date' => $data['timestamp'],
            'X-Date' => $data['timestamp'],
            'Authorization' => $authHeader,
            'X-Authorization' => $authHeader,
            'Content-Type' => $contentType
        ];

        return $this;
    }

    /**
     * @param string $sharedSecret
     * @param string $url
     * @param string $body
     * @param string $method
     * @param bool $rfcCompliantTimezone
     * @return $this
     * @throws \Exception
     */
    public function signJson($sharedSecret, $url, $body, $method, $rfcCompliantTimezone = false, $newAlgo = false)
    {
        $contentType = 'application/json; charset=utf-8';

        $data = $this->getSignRequestData(
            $url,
            $sharedSecret,
            $method,
            $body,
            $contentType,
            $rfcCompliantTimezone,
            $newAlgo,
            true
        );

        $this->additionalHeaders = [
            'Date' => $data['timestamp'],
            'X-Date' => $data['timestamp'],
            'X-Signature' => $data['signature'],
            'Content-Type' => $contentType
        ];

        return $this;
    }

    /**
     * @param $sharedSecret
     * @param $url
     * @param $body
     * @param $method
     * @param $rfcCompliantTimezone
     * @param $newAlgo
     * @return $this
     */
    public function signMultiPart($sharedSecret, $url, $body, $method, $rfcCompliantTimezone = false, $newAlgo = false)
    {
        $contentType = 'multipart/form-data';

        $data = $this->getSignRequestData(
            $url,
            $sharedSecret,
            $method,
            '',
            $contentType,
            $rfcCompliantTimezone,
            $newAlgo,
            true
        );

        $this->additionalHeaders = [
            'Date' => $data['timestamp'],
            'X-Date' => $data['timestamp'],
            'X-Signature' => $data['signature'],
            'Content-Type' => $contentType
        ];

        return $this;
    }

    /**
     * @param $url
     * @param $sharedSecret
     * @param $method
     * @param $body
     * @param $contentType
     * @param $rfcCompliantTimezone
     * @param $newAlgo
     * @param $forJsonApi
     * @return array
     * @throws \Exception
     */
    protected function getSignRequestData(
        $url,
        $sharedSecret,
        $method,
        $body,
        $contentType,
        $rfcCompliantTimezone = false,
        $newAlgo = false,
        $forJsonApi = false
    ) {
        $timestamp = ($rfcCompliantTimezone) ?
            (new \DateTime('now', new \DateTimeZone('UTC')))->format('D, d M Y H:i:s \G\M\T') :
            (new \DateTime('now', new \DateTimeZone('UTC')))->format('D, d M Y H:i:s T');

        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        $anchor = parse_url($url, PHP_URL_FRAGMENT);

        $requestUri = $path . ($query ? '?' . $query : '') . ($anchor ? '#' . $anchor : '');

        $signature = $this->createSignature(
            $sharedSecret,
            $method,
            $body,
            $contentType,
            $timestamp,
            $requestUri,
            $forJsonApi,
            $newAlgo
        );

        return [
            'timestamp' => $timestamp,
            'signature' => $signature,
        ];
    }

    /**
     * @param string $sharedSecret
     * @param string $method
     * @param string $body
     * @param string $contentType
     * @param string $timestamp
     * @param string $requestUri
     *
     * @return string
     */
    public function createSignature($sharedSecret, $method, $body, $contentType, $timestamp, $requestUri, $forJsonApi = false, $newAlgo = false) {
        if ($forJsonApi) {
            $parts = array($method, $newAlgo ? hash('sha512', $body, false) : md5($body), $contentType, $timestamp, $requestUri);
        } else {
            $parts = array($method, $newAlgo ? hash('sha512', $body, false) : md5($body), $contentType, $timestamp, '', $requestUri);
        }

        $str = implode("\n", $parts);
        $digest = hash_hmac('sha512', $str, $sharedSecret, true);
        return base64_encode($digest);
    }

    /**
     * @return int
     */
    private function getResponseCode() {
        return (int)curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
    }

    /**
     * @return int
     */
    private function getErrno() {
        return curl_errno($this->handle);
    }

    /**
     * @return string
     */
    private function getError() {
        return curl_error($this->handle);
    }

    /**
     * @param array $headers1
     * @param array $headers2
     *
     * @return array
     */
    private function mergeHeaders($headers1, $headers2) {
        $ret = array();
        foreach ($headers1 as $k => $v) {
            if (is_numeric($k)) {
                $name = substr($v, 0, strpos($v, ':'));
                $value = trim(substr($v, strpos($v, ':') + 1));
                $ret[$name] = $value;
            } else {
                $ret[$k] = $v;
            }
        }
        foreach ($headers2 as $k => $v) {
            if (is_numeric($k)) {
                $name = substr($v, 0, strpos($v, ':'));
                $value = trim(substr($v, strpos($v, ':') + 1));
                $ret[$name] = $value;
            } else {
                $ret[$k] = $v;
            }
        }
        return $ret;
    }
}
