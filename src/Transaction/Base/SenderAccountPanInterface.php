<?php

namespace Ixopay\Client\Transaction\Base;

interface SenderAccountPanInterface
{
    public function getSenderAccountReferenceUuid();
    public function setSenderAccountReferenceUuid(string $senderAccountReferenceUuid);
}
