<?php

namespace Ixopay\Client;
use Ixopay\Client\Exception\ClientException;
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
use Ixopay\Client\Xml\Generator;
use Ixopay\Client\Xml\Parser;

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
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var bool
     */
    protected $testMode;

    /**
     * @param string $username
     * @param string $password
     * @param string $apiKey
     * @param string $sharedSecret
     * @param string $language
     * @param bool $testMode
     */
    public function __construct($username, $password, $apiKey, $sharedSecret, $language=null, $testMode = false) {
        $this->username = $username;
        $this->password = $password;
        $this->apiKey = $apiKey;
        $this->sharedSecret = $sharedSecret;
        $this->language = $language;
        $this->testMode = $testMode;
    }

    /**
     * @param AbstractTransaction $transaction
     * @return Result
     */
    public function sendTransaction($transactionMethod, AbstractTransaction $transaction) {
        $dom = $this->getGenerator()->generateTransaction($transactionMethod, $transaction, $this->username, $this->password, $this->language, $this->testMode);
        $xml = $dom->saveXML();

        $response = $this->signAndSendXml($xml, $this->apiKey, $this->sharedSecret, self::$ixopayUrl);

        if ($response->getErrorCode() || $response->getErrorMessage()) {
            throw new ClientException('Request failed: '.$response->getErrorCode().' '.$response->getErrorMessage());
        }

        $parser = $this->getParser();
        return $parser->parseResult($response->getBody());
    }


    /**
     * @param string $xml
     * @param string $apiKey
     * @param string $sharedSecret
     * @param string $url
     * @return Response
     */
    public function signAndSendXml($xml, $apiKey, $sharedSecret, $url) {

        $curl = new CurlClient();
        return $curl->sign($apiKey, $sharedSecret, $url, $xml)
            ->post($url, $xml);
    }

    /**
     * @param Register $transactionData
     * @return Result
     */
    public function register(Register $transactionData) {
        return $this->sendTransaction('register', $transactionData);
    }

    /**
     * @param Register $transactionData
     * @return Result
     */
    public function completeRegister(Register $transactionData) {
        return $this->sendTransaction('completeRegister', $transactionData);
    }

    /**
     * @param Deregister $transactionData
     * @return Result
     */
    public function deregister(Deregister $transactionData) {
        return $this->sendTransaction('deregister', $transactionData);
    }

    /**
     * @param Preauthorize $transactionData
     * @return Result
     */
    public function preauthorize(Preauthorize $transactionData) {
        return $this->sendTransaction('preauthorize', $transactionData);
    }

    /**
     * @param Preauthorize $transactionData
     * @return Result
     */
    public function completePreauthorize(Preauthorize $transactionData) {
        return $this->sendTransaction('completePreauthorize', $transactionData);
    }

    /**
     * @param Void $transactionData
     *
     * @return Result
     */
    public function void(Void $transactionData) {
        return $this->sendTransaction('void', $transactionData);
    }

    /**
     * @param Capture $transactionData
     * @return Result
     */
    public function capture(Capture $transactionData) {
        return $this->sendTransaction('capture', $transactionData);
    }

    /**
     * @param Refund $transactionData
     * @return Result
     */
    public function refund(Refund $transactionData) {
        return $this->sendTransaction('refund', $transactionData);
    }

    /**
     * @param Debit $transactionData
     * @return Result
     */
    public function debit(Debit $transactionData) {
        return $this->sendTransaction('debit', $transactionData);
    }

    /**
     * @param Debit $transactionData
     * @return Result
     */
    public function completeDebit(Debit $transactionData) {
        return $this->sendTransaction('completeDebit', $transactionData);
    }

    /**
     * @param $requestBody
     * @return Callback\Result
     * @throws Exception\InvalidValueException
     */
    public function readPostback($requestBody) {
        return $this->getParser()->parseCallback($requestBody);
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
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language) {
        $this->language = $language;
    }

    /**
     * @return boolean
     */
    public function isTestMode() {
        return $this->testMode;
    }

    /**
     * @param boolean $testMode
     */
    public function setTestMode($testMode) {
        $this->testMode = $testMode;
    }

    /**
     * @return Generator
     */
    protected function getGenerator() {
        return new Generator();
    }

    /**
     * @return Parser
     */
    protected function getParser() {
        return new Parser();
    }


}