<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransactionWithReference;
use Ixopay\Client\Transaction\Base\AddToCustomerProfileInterface;
use Ixopay\Client\Transaction\Base\AddToCustomerProfileTrait;
use Ixopay\Client\Transaction\Base\AmountableInterface;
use Ixopay\Client\Transaction\Base\AmountableTrait;
use Ixopay\Client\Transaction\Base\CustomerInterface;
use Ixopay\Client\Transaction\Base\CustomerTrait;
use Ixopay\Client\Transaction\Base\IndicatorInterface;
use Ixopay\Client\Transaction\Base\IndicatorTrait;
use Ixopay\Client\Transaction\Base\ItemsInterface;
use Ixopay\Client\Transaction\Base\ItemsTrait;
use Ixopay\Client\Transaction\Base\LevelTwoAndThreeDataInterface;
use Ixopay\Client\Transaction\Base\LevelTwoAndThreeDataTrait;
use Ixopay\Client\Transaction\Base\OffsiteInterface;
use Ixopay\Client\Transaction\Base\OffsiteTrait;
use Ixopay\Client\Transaction\Base\PayByLinkTrait;
use Ixopay\Client\Transaction\Base\DccDataInterface;
use Ixopay\Client\Transaction\Base\DccDataTrait;
use Ixopay\Client\Transaction\Base\ReferenceSchemeTransactionIdentifierInterface;
use Ixopay\Client\Transaction\Base\ReferenceSchemeTransactionIdentifierTrait;
use Ixopay\Client\Transaction\Base\ScheduleInterface;
use Ixopay\Client\Transaction\Base\ScheduleTrait;
use Ixopay\Client\Transaction\Base\RecipientAccountPanInterface;
use Ixopay\Client\Transaction\Base\RecipientAccountPanTrait;
use Ixopay\Client\Transaction\Base\SurchargeInterface;
use Ixopay\Client\Transaction\Base\SurchargeTrait;
use Ixopay\Client\Transaction\Base\TransactionSplitsInterface;
use Ixopay\Client\Transaction\Base\TransactionSplitsTrait;
use Ixopay\Client\Transaction\Base\ThreeDSecureInterface;
use Ixopay\Client\Transaction\Base\ThreeDSecureTrait;

/**
 * Preauthorize: Reserve a certain amount, which can be captured (=charging) or voided (=revert) later on.
 *
 * @package Ixopay\Client\Transaction
 */
class Preauthorize extends AbstractTransactionWithReference
                   implements AddToCustomerProfileInterface,
                              AmountableInterface,
                              CustomerInterface,
                              ItemsInterface,
                              TransactionSplitsInterface,
                              OffsiteInterface,
                              ScheduleInterface,
                              ThreeDSecureInterface,
                              IndicatorInterface,
                              DccDataInterface,
                              SurchargeInterface,
                              ReferenceSchemeTransactionIdentifierInterface,
                              RecipientAccountPanInterface,
                              LevelTwoAndThreeDataInterface
{

    use AddToCustomerProfileTrait;
    use AmountableTrait;
    use CustomerTrait;
    use ItemsTrait;
    use TransactionSplitsTrait;
    use OffsiteTrait;
    use ScheduleTrait;
    use ThreeDSecureTrait;
    use PayByLinkTrait;
    use IndicatorTrait;
    use DccDataTrait;
    use SurchargeTrait;
    use ReferenceSchemeTransactionIdentifierTrait;
    use RecipientAccountPanTrait;
    use LevelTwoAndThreeDataTrait;

    const TRANSACTION_INDICATOR_SINGLE = 'SINGLE';
    const TRANSACTION_INDICATOR_INITIAL = 'INITIAL';
    const TRANSACTION_INDICATOR_RECURRING = 'RECURRING';
    const TRANSACTION_INDICATOR_CARDONFILE = 'CARDONFILE';
    const TRANSACTION_INDICATOR_CARDONFILE_MERCHANT = 'CARDONFILE-MERCHANT-INITIATED';

    /** @var string */
    protected $transactionToken;

    /** @var bool */
    protected $withRegister = false;

    /** @var string */
    protected $language;

    /** @var int */
    protected $captureInMinutes = 0;

    /**
     * @return string
     */
    public function getTransactionToken()
    {
        return $this->transactionToken;
    }

    /**
     * @param string $transactionToken
     */
    public function setTransactionToken($transactionToken)
    {
        $this->transactionToken = $transactionToken;
    }

    /**
     * @return boolean
     */
    public function isWithRegister() {
        return $this->withRegister;
    }

    /**
     * set true if you want to register a user vault together with the debit
     *
     * @param boolean $withRegister
     *
     * @return $this
     */
    public function setWithRegister($withRegister) {
        $this->withRegister = $withRegister;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get auto-capture in minutes.
     *
     * Returns 0 by default, indicating no auto-capture shall be performed.
     *
     * @return int
     */
    public function getCaptureInMinutes()
    {
        return $this->captureInMinutes;
    }

    /**
     * Set auto-capture in minutes.
     *
     * Provided value must be an int and equal or greater 0.
     * A value of 0 means no capture shall be performed automatically.
     * A value greater zero, requests the gateway to schedule a capture
     * automatically after n minutes.
     *
     * @param  int  $captureInMinutes
     * @return Preauthorize
     */
    public function setCaptureInMinutes($captureInMinutes)
    {
        $this->captureInMinutes = $captureInMinutes;

        return $this;
    }
}
