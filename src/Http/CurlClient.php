<?php

namespace Ixopay\Client\Http;

use Ixopay\Client\Http\Exception\ClientException;

/**
 * Class CurlClient
 *
 * @package Ixopay\Client\Http
 */
class CurlClient implements ClientInterface{

    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';

	/**
	 * @var resource
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
     *
     */
    public function __construct() {
		$this->handle = curl_init();
		$this->setOptionArray(self::$defaultOptions);
	}

    /**
     * @param string $option
     * @param mixed $value
     */
    public static function setDefaultOption($option, $value){
		self::$defaultOptions[$option] = $value;
	}

    /**
     * @param array $options
     */
    public static function setDefaultOptions(array $options) {
		self::$defaultOptions = $options;
	}

    /**
     * @param string $option
     * @param mixed $value
     * @return $this
     */
    public function setOption($option, $value){
		curl_setopt($this->handle, $option, $value);
		return $this;
	}

    /**
     * @param array $options
     * @return $this
     */
    public function setOptionArray(array $options){
		curl_setopt_array($this->handle, $options);
		return $this;
	}

    /**
     * @param string $username
     * @param string $password
     */
    public function setAuthentication($username, $password) {
		curl_setopt($this->handle, CURLOPT_USERPWD, $username.':'.$password);
	}

    /**
     *
     */
    public function __destruct(){
		if (is_resource($this->handle)) {
			curl_close($this->handle);
		}
	}

	/**
	 * Execute the request and return the response
	 * @param string $method
	 * @param string $url
	 * @param array $headers
	 * @return mixed
	 */
	public function send($method, $url, array $headers=[]) {

		$this->setOption(CURLOPT_URL, $url);

		if (!empty($headers)) {
			$this->setOption(CURLOPT_HTTPHEADER, $headers);
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
     * @param array $headers
     * @return mixed
     */
    public function get($url, array $headers = []) {
		return $this->send(self::METHOD_GET, $url, $headers);
	}

	/**
	 * @param string $url
	 * @param string|array $body
	 * @param array $headers
	 * @return Response
	 * @throws ClientException
	 */
	public function post($url, $body, array $headers = []) {

		if ($body && is_string($body)) {
			$this->setOption(CURLOPT_CUSTOMREQUEST, "POST");
			$this->setOption(CURLOPT_POSTFIELDS, $body);
		} elseif($body && is_array($body)) {
			$this->setOption(CURLOPT_POST, 1);
			$this->setOption(CURLOPT_POSTFIELDS, http_build_query($body));
		} else {
			throw new ClientException('invalid body datatype allowed: string and array');
		}

		return $this->send(self::METHOD_POST, $url, $headers);
	}

	/**
	 * @param string $url
	 * @param string|array $body
	 * @param array $headers
	 * @return mixed
	 * @throws ClientException
	 */
	public function put($url, $body, array $headers = []) {
		if (is_string($body)) {
			$this->setOption(CURLOPT_CUSTOMREQUEST, "PUT");
			$this->setOption(CURLOPT_POSTFIELDS, $body);
		} elseif($body && is_array($body)) {
			$this->setOption(CURLOPT_CUSTOMREQUEST, "PUT");
			$this->setOption(CURLOPT_POSTFIELDS, http_build_query($body));
		} else {
			throw new ClientException('invalid body datatype allowed: string and array');
		}

		return $this->send(self::METHOD_PUT, $url, $headers);
	}

    /**
     * @return int
     */
    private function getResponseCode() {
		return (int) curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
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

}