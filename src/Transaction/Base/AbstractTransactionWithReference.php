<?php

namespace Ixopay\Client\Transaction\Base;

/**
 * Class AbstractReferenced
 *
 * @package Ixopay\Client\Transaction
 */
abstract class AbstractTransactionWithReference extends AbstractTransaction {

    /**
     * @var string
     */
    protected $referenceTransactionId;

    /**
     * @var string
     */
    protected $referenceCustomerId;

    /**
     * @var string
     */
    protected $referenceId2;

    /**
     * @var string
     */
    protected $referenceId3;

    /**
     * @var string
     */
    protected $referenceId4;

    /**
     * @return string
     */
    public function getReferenceTransactionId() {
        return $this->referenceTransactionId;
    }

    /**
     * provide a reference transaction id (or registration id) here if necessary (i.e. for void/capture/refund or
     * recurring debits)
     *
     * @param string $referenceTransactionId
     *
     * @return $this
     */
    public function setReferenceTransactionId($referenceTransactionId) {
        $this->referenceTransactionId = $referenceTransactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceCustomerId() {
        return $this->referenceCustomerId;
    }

    /**
     * set a reference customer if (if instructed by documentation)
     *
     * @param string $referenceCustomerId
     *
     * @return $this
     */
    public function setReferenceCustomerId($referenceCustomerId) {
        $this->referenceCustomerId = $referenceCustomerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceId2() {
        return $this->referenceId2;
    }

    /**
     * @param string $referenceId2
     *
     * @return $this
     */
    public function setReferenceId2($referenceId2) {
        $this->referenceId2 = $referenceId2;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceId3() {
        return $this->referenceId3;
    }

    /**
     * @param string $referenceId3
     *
     * @return $this
     */
    public function setReferenceId3($referenceId3) {
        $this->referenceId3 = $referenceId3;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceId4() {
        return $this->referenceId4;
    }

    /**
     * @param string $referenceId4
     *
     * @return $this
     */
    public function setReferenceId4($referenceId4) {
        $this->referenceId4 = $referenceId4;
        return $this;
    }


}