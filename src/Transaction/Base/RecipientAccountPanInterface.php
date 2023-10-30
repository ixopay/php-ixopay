<?php

namespace Ixopay\Client\Transaction\Base;

interface RecipientAccountPanInterface
{
    /** @return string|null */
    public function getRecipientAccountReferenceUuid();

    /** @param string $recipientAccountReferenceUuid */
    public function setRecipientAccountReferenceUuid($recipientAccountReferenceUuid);
}
