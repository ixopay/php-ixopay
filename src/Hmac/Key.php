<?php

namespace Ixopay\Client\Hmac;

use Acquia\Hmac\KeyInterface;

/**
 * Class Key
 *
 * @package Ixopay\Client\Hmac
 */
class Key implements KeyInterface{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret) {
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSecret() {
        return $this->secret;
    }



}