<?php


namespace Ixopay\Client\Data;


class PayByLinkData
{
    /**
     * @var bool
     */
    protected $sendByEmail = false;

    /**
     * @var int
     */
    protected $expirationInMinute;

    /**
     * @return bool
     */
    public function isSendByEmail()
    {
        return $this->sendByEmail;
    }

    /**
     * @param bool $sendByEmail
     */
    public function setSendByEmail($sendByEmail)
    {
        $this->sendByEmail = $sendByEmail;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpirationInMinute()
    {
        return $this->expirationInMinute;
    }

    /**
     * @param int $expirationInMinute
     */
    public function setExpirationInMinute($expirationInMinute)
    {
        $this->expirationInMinute = $expirationInMinute;
        return $this;
    }
}
