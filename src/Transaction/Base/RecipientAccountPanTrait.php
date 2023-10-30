<?php

namespace Ixopay\Client\Transaction\Base;

trait RecipientAccountPanTrait
{
    /** @var null|string */
    protected $recipientAccountReferenceUuid = null;

    /** @return null|string */
    public function getRecipientAccountReferenceUuid()
    {
        return $this->recipientAccountReferenceUuid;
    }

    /** @param string $recipientAccountReferenceUuid */
    public function setRecipientAccountReferenceUuid($recipientAccountReferenceUuid)
    {
        $this->recipientAccountReferenceUuid = $recipientAccountReferenceUuid;
    }

}
