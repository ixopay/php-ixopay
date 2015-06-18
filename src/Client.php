<?php

namespace Ixopay\Client;
use GuzzleHttp\Message\Request;
use Acquia\Hmac\RequestSigner;
use Acquia\Hmac\Digest\Version1;
use Acquia\Hmac\Guzzle5\HmacAuthPlugin;
use GuzzleHttp\Stream\Stream;

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
        $client->getEmitter()->attach(new HmacAuthPlugin($signer, $this->apiKey, $this->sharedSecret));

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
        //$request->addHeader('Date', time());

        return $request;
    }

    protected function sendRequest() {

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




}