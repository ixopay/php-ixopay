<?php

namespace Ixopay\Client\Dispute;

class DisputeResult
{
    /**
     * @var bool
     */
    private $success = false;
    /**
     * @var array
     */
    private $extraData = [];
    /**
     * @var array
     */
    private $metaData = [];
    /**
     * @var Error[]
     */
    private $errors = [];

    /**
     * @param $bool
     * @return $this
     */
    public function setSuccess($bool)
    {
        $this->success = $bool;
        return $this;
    }

    /**
     * @return bool
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param $extraData
     * @return $this
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * @param $metaData
     * @return $this
     */
    public function setMetaData($metaData)
    {
        $this->metaData = $metaData;
        return $this;
    }

    /**
     * @return array
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

    /**
     * @param Error[] $errors
     *
     * @return $this
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return Error[]
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
