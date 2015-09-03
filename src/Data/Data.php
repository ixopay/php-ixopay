<?php

namespace Ixopay\Client\Data;

/**
 * Class Data
 *
 * @package Ixopay\Client\Data
 */
abstract class Data {

    /** @var array  */
    protected $extraData = array();

    /**
     * @param array $extraData
     *
     * @return $this
     */
    public function setExtraData($extraData) {
        $this->extraData = $extraData;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraData() {
        return $this->extraData;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function addExtraData($key, $value) {
        $this->extraData[$key] = $value;
        return $this;
    }


    /**
     * get data from extra data
     *
     * @param string $key
     *
     * @return mixed|null
     */
    public function __get($key) {
        if (array_key_exists($key, $this->extraData)) {
            return $this->extraData[$key];
        }
        return null;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function __set($key, $value) {
        $setter = 'set' . ucfirst($key);
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } else {
            $this->addExtraData($key, $value);
        }

    }

}