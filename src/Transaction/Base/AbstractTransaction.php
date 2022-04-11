<?php

namespace Ixopay\Client\Transaction\Base;

use Ixopay\Client\Data\Request;

/**
 * Class AbstractTransaction
 *
 * @package Ixopay\Client\Transaction
 */
class AbstractTransaction {

    /**
     * @deprecated use $merchantTransactionId
     *
     * @var string
     */
    protected $transactionId;

    /**
     * @var string
     */
    protected $merchantTransactionId;

    /**
     * @var string
     */
    protected $additionalId1;

    /**
     * @var string
     */
    protected $additionalId2;

    /**
     * @var array
     */
    protected $extraData = array();

    /**
     * @var string
     */
    protected $merchantMetaData;

    /**
     * @deprecated not in use anymore
     * @var Request
     */
    protected $request;

    /**
     * @deprecated use getMerchantTransactionId()
     *
     * @return string
     */
    public function getTransactionId() {
        return $this->merchantTransactionId;
    }

    /**
     * @deprecated use setMerchantTransactionId()
     *
     * this is your own transaction id
     * NOTE: your transaction ids MUST be unique
     *
     * @param string $transactionId
     *
     * @return $this
     */
    public function setTransactionId($transactionId) {
        $this->merchantTransactionId = $transactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantTransactionId()
    {
        return $this->merchantTransactionId;
    }

    /**
     * @param string $merchantTransactionId
     *
     * @return $this
     */
    public function setMerchantTransactionId($merchantTransactionId)
    {
        $this->merchantTransactionId = $merchantTransactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalId1() {
        return $this->additionalId1;
    }

    /**
     * any additional id if required by the payment method
     *
     * @param string $additionalId1
     *
     * @return $this
     */
    public function setAdditionalId1($additionalId1) {
        $this->additionalId1 = $additionalId1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalId2() {
        return $this->additionalId2;
    }

    /**
     * any additional id if required by the payment method
     *
     * @param string $additionalId2
     *
     * @return $this
     */
    public function setAdditionalId2($additionalId2) {
        $this->additionalId2 = $additionalId2;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraData() {
        return $this->extraData;
    }

    /**
     * any additional data if required by the payment method
     *
     * @param array $extraData
     *
     * @return $this
     */
    public function setExtraData($extraData) {
        $this->extraData = $extraData;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantMetaData()
    {
        return $this->merchantMetaData;
    }

    /**
     * @param string $merchantMetaData
     * @return $this
     */
    public function setMerchantMetaData($merchantMetaData)
    {
        $this->merchantMetaData = $merchantMetaData;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
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
     * alternative to magic method
     *
     * @param $key
     *
     * @return mixed|null
     */
    public function getExtraDataValue($key) {
        if (array_key_exists($key, $this->extraData)) {
            return $this->extraData[$key];
        }
        return null;
    }

    /**
     * @deprecated not in use anymore
     * @return Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * @deprecated not in use anymore
     *
     * provider request information here (if required by the payment method)
     *
     * @param Request $request
     *
     * @return $this
     */
    public function setRequest($request) {
        $this->request = $request;
        return $this;
    }

}