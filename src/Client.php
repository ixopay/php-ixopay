<?php

namespace Ixopay\Client;
use Ixopay\Client\Http\CurlClient;
use Ixopay\Client\Http\Response;
use Ixopay\Client\Transaction\Base\AbstractTransaction;
use Ixopay\Client\Transaction\Capture;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Deregister;
use Ixopay\Client\Transaction\Preauthorize;
use Ixopay\Client\Transaction\Refund;
use Ixopay\Client\Transaction\Register;
use Ixopay\Client\Transaction\Result;
use Ixopay\Client\Transaction\Void;

/**
 * Class Client
 *
 * @package Ixopay\Client
 */
class Client {

    /**
     * @var string
     */
    protected static $ixopayUrl = 'http://ixopay.x/transaction';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $sharedSecret;

    /**
     * @param string $apiKey
     * @param string $sharedSecret
     */
    public function __construct($apiKey, $sharedSecret) {
        $this->apiKey = $apiKey;
        $this->sharedSecret = $sharedSecret;
    }

    /**
     * @param AbstractTransaction $transaction
     * @return Result
     */
    public function sendTransaction(AbstractTransaction $transaction) {
        $xml = '';

        $this->signAndSendXml($xml, $this->apiKey, $this->sharedSecret, self::$ixopayUrl);
    }


    /**
     * @param string $xml
     * @param string $apiKey
     * @param string $sharedSecret
     * @param string $url
     * @return Response
     */
    public function signAndSendXml($xml, $apiKey, $sharedSecret, $url) {

        $timestamp = (new \DateTime('now',new \DateTimeZone('UTC')))->format('D, d M Y H:i:s T');

        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        $anchor = parse_url($url, PHP_URL_FRAGMENT);

        $requestUri = $path.($query ? '?'.$query : '').($anchor ? '#'.$anchor : '');

        $contentType = 'text/xml; charset=utf-8';

        $signature = $this->createSignature($sharedSecret, 'POST', $xml, $contentType , $timestamp, $requestUri);
        $authHeader = 'IxoPay ' . $apiKey . ':' . $signature;

        $headers = array(
            'Date: '.$timestamp,
            'Authorization: '.$authHeader,
            'Content-Type: '.$contentType
        );

        return $this->sendRequest($xml, $headers, $url);

    }

    /**
     * @param string $sharedSecret
     * @param string $method
     * @param string $body
     * @param string $contentType
     * @param string $timestamp
     * @param string $requestUri
     * @return string
     */
    protected function createSignature($sharedSecret, $method, $body, $contentType, $timestamp, $requestUri) {
        $parts = array($method, md5($body), $contentType, $timestamp, '', $requestUri);

        $str = join("\n", $parts);
        $digest = hash_hmac('sha512', $str, $sharedSecret, true);
        return base64_encode($digest);
    }

    /**
     * @param string $body
     * @param string $header
     * @param string $url
     * @return Response
     */
    public function sendRequest($body, $headers, $url) {
        $curl = new CurlClient();
        return $curl->post($url, $body, $headers);
    }

    /**
     * @return string
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getSharedSecret() {
        return $this->sharedSecret;
    }

    /**
     * @param string $sharedSecret
     */
    public function setSharedSecret($sharedSecret) {
        $this->sharedSecret = $sharedSecret;
    }

    /**
     * @param Register $transactionData
     * @return Result
     */
    public function register(Register $transactionData) {

    }

    /**
     * @param Register $transactionData
     * @return Result
     */
    public function completeRegister(Register $transactionData) {

    }

    /**
     * @param Deregister $transactionData
     * @return Result
     */
    public function deregister(Deregister $transactionData) {

    }

    /**
     * @param Preauthorize $transactionData
     * @return Result
     */
    public function preauthorize(Preauthorize $transactionData) {

    }

    /**
     * @param Preauthorize $transactionData
     * @return Result
     */
    public function completePreauthorize(Preauthorize $transactionData) {

    }

    /**
     * @param Void $transactionData
     *
     * @return Result
     */
    public function void(Void $transactionData) {

    }

    /**
     * @param Capture $transactionData
     * @return Result
     */
    public function capture(Capture $transactionData) {

    }

    /**
     * @param Refund $transactionData
     * @return Result
     */
    public function refund(Refund $transactionData) {

    }

    /**
     * @param Debit $transactionData
     * @return Result
     */
    public function debit(Debit $transactionData) {

    }

    /**
     * @param Debit $transactionData
     * @return Result
     */
    public function completeDebit(Debit $transactionData) {

    }


}