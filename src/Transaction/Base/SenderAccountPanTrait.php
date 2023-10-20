<?php

namespace Ixopay\Client\Transaction\Base;

trait SenderAccountPanTrait
{
    /** @var null|string */
    protected $senderAccountReferenceUuid = null;

    /** @return null|string */
    public function getSenderAccountReferenceUuid()
    {
        return $this->senderAccountReferenceUuid;
    }

    /** @param string $senderAccountReferenceUuid */
    public function setSenderAccountReferenceUuid($senderAccountReferenceUuid)
    {
        $this->senderAccountReferenceUuid = $senderAccountReferenceUuid;
    }

}
