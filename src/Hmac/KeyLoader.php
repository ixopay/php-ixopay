<?php

namespace Ixopay\Client\Hmac;

use Acquia\Hmac\KeyLoaderInterface;

/**
 * Class KeyLoader
 *
 * @package Ixopay\Client\Hmac
 */
class KeyLoader implements KeyLoaderInterface {

    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $key
     */
    function __construct($key) {
        $this->key = $key;
    }


    /**
     * @param string $id
     *
     * @return \Acquia\Hmac\KeyInterface|false
     */
    public function load($id) {
        $k = new Key();
        $k->setId($id);
        $k->setSecret($this->key);

        return $k;
    }


}