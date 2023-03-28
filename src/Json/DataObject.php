<?php

namespace Ixopay\Client\Json;

use Ixopay\Client\CustomerProfile\CustomerData;
use Ixopay\Client\CustomerProfile\PaymentInstrument;
use Ixopay\Client\Data\PaymentData\IbanData;
use Ixopay\Client\Data\PaymentData\WalletData;
use Ixopay\Client\Data\ThreeDSecureData;

/**
 * Class DataObject
 *
 * @package Ixopay\Client\Json
 */
class DataObject implements \ArrayAccess, \JsonSerializable {

    /**
     * @var array
     */
    protected $_data = array();

    protected static $_typeMap = array(
        'customerData' => CustomerData::class,
        'paymentInstrument' => PaymentInstrument::class,
        'paymentData.iban' => IbanData::class,
        'paymentData.wallet' => WalletData::class,
        'threeDSecureData' => ThreeDSecureData::class,
    );

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name) {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
        return null;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) {
        if (method_exists($this, 'set'.ucfirst($name))) {
            $this->{'set'.ucfirst($name)}($value);
        } else {
            $this->_data[$name] = $value;
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name) {
        return isset($this->_data[$name]);
    }

    /**
     * @param string $name
     */
    public function __unset($name) {
        if (array_key_exists($name, $this->_data)) {
            unset($this->_data[$name]);
        }
    }

    /**
     * @return string
     */
    public function __toString() {
        /** @noinspection MagicMethodsValidityInspection */
        return json_encode($this->_data) ?: '';
    }


    /**
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, $this->_data);
    }

    /**
     * @param string $offset
     * @return mixed|null
     */
    public function offsetGet($offset) {
        return $this->__get($offset);
    }

    /**
     * @param string $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value) {
        return $this->__set($offset, $value);
    }

    /**
     * @param string $offset
     */
    public function offsetUnset($offset) {
        $this->__unset($offset);
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return $this->_data;
    }

    /**
     * @return array
     */
    public function toArray() {
        return $this->_data;
    }

    /**
     * @param array $data
     */
    public function _populateFromResponse($data) {
        foreach ($data as $k=>$v) {
            if (is_array($v)) {
                $arr = array();
                foreach ($v as $arrK => $arrV) {
                    if (is_object($arrV)) {
                        if (!empty($arrV->_TYPE)) {
                            if (array_key_exists($arrV->_TYPE, static::$_typeMap)) {
                                $objClass = static::$_typeMap[$arrV->_TYPE];
                            } else {
                                $objClass = DataObject::class;
                            }
                        } else {
                            $objClass = DataObject::class;
                        }
                        /** @var DataObject $obj */
                        $obj = new $objClass();
                        $obj->_populateFromResponse($arrV);
                        $arr[$arrK] = $obj;
                    } else {
                        $arr[$arrK] = $arrV;
                    }
                }
                $this->$k = $arr;
            } elseif (is_object($v)) {
                if (!empty($v->_TYPE)) {
                    if (array_key_exists($v->_TYPE, static::$_typeMap)) {
                        $objClass = static::$_typeMap[$v->_TYPE];
                    } else {
                        $objClass = DataObject::class;
                    }
                } else {
                    $objClass = DataObject::class;
                }
                /** @var DataObject $obj */
                $obj = new $objClass();
                $obj->_populateFromResponse($v);
                $this->$k = $obj;
            } else {
                $this->$k = $v;
            }
        }
    }
}
