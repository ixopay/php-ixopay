<?php

namespace Ixopay\Client;
use Acquia\Hmac\RequestAuthenticator;
use GuzzleHttp\Message\Request;
use Acquia\Hmac\RequestSigner;
use Acquia\Hmac\Digest\Version1;
use Acquia\Hmac\Guzzle5\HmacAuthPlugin;
use GuzzleHttp\Stream\Stream;
use Ixopay\Client\Hmac\KeyLoader;
use Ixopay\Client\Transaction\Capture;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Deregister;
use Ixopay\Client\Transaction\Preauthorize;
use Ixopay\Client\Transaction\Refund;
use Ixopay\Client\Transaction\Register;
use Ixopay\Client\Transaction\Result;
use Ixopay\Client\Transaction\Void;
use Ixopay\Http\Response;

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



    public function signAndSendXml($xml) {
        $request = $this->buildRequest($xml);

        $signer = new RequestSigner(new Version1('sha512'));
        $signer->setProvider('IxoPay');

        $client = new \GuzzleHttp\Client();
        $request->getEmitter()->attach(new HmacAuthPlugin($signer, $this->apiKey, $this->sharedSecret));

        $response = $client->send($request);

        return $response;
    }

    /**
     * @param $xml
     * @return \GuzzleHttp\Message\Request
     */
    protected function buildRequest($xml) {
        $body = Stream::factory($xml);
        $request = new Request('POST', self::$ixopayUrl, array(), $body);

        return $request;
    }

    public function sendRequest() {

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