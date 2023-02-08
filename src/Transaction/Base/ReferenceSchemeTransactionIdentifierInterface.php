<?php

namespace Ixopay\Client\Transaction\Base;

interface ReferenceSchemeTransactionIdentifierInterface
{
    public function setReferenceSchemeTransactionIdentifier($referenceSchemeTransactionIdentifier);

    public function getReferenceSchemeTransactionIdentifier();
}
