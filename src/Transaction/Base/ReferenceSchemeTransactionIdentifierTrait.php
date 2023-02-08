<?php

namespace Ixopay\Client\Transaction\Base;

trait ReferenceSchemeTransactionIdentifierTrait
{
    protected $referenceSchemeTransactionIdentifier;

    /**
     * @return string|null
     */
    public function getReferenceSchemeTransactionIdentifier()
    {
        return $this->referenceSchemeTransactionIdentifier;
    }

    /**
     * @param string $referenceSchemeTransactionIdentifier
     */
    public function setReferenceSchemeTransactionIdentifier($referenceSchemeTransactionIdentifier)
    {
        $this->referenceSchemeTransactionIdentifier = $referenceSchemeTransactionIdentifier;
        return $this;
    }

}
