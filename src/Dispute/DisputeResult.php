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
