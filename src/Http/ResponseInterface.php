<?php

namespace Ixopay\Client\Http;

/**
 * Interface ResponseInterface
 *
 * @package Ixopay\Client\Http
 */
interface ResponseInterface {

	/**
	 * @return int
	 */
	public function getStatusCode();

	/**
	 * @return mixed
	 */
	public function getBody();

	/**
	 * @return array
	 */
	public function getHeaders();

	/**
	 * @return mixed
	 */
	public function json(array $config = array());

}