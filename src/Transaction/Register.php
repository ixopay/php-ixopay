<?php

namespace Ixopay\Client\Transaction;

use Ixopay\Client\Transaction\Base\AbstractTransaction;
use Ixopay\Client\Transaction\Base\AddToCustomerProfileInterface;
use Ixopay\Client\Transaction\Base\AddToCustomerProfileTrait;
use Ixopay\Client\Transaction\Base\CustomerInterface;
use Ixopay\Client\Transaction\Base\CustomerTrait;
use Ixopay\Client\Transaction\Base\IndicatorInterface;
use Ixopay\Client\Transaction\Base\IndicatorTrait;
use Ixopay\Client\Transaction\Base\LevelTwoAndThreeDataInterface;
use Ixopay\Client\Transaction\Base\LevelTwoAndThreeDataTrait;
use Ixopay\Client\Transaction\Base\OffsiteInterface;
use Ixopay\Client\Transaction\Base\OffsiteTrait;
use Ixopay\Client\Transaction\Base\PayByLinkTrait;
use Ixopay\Client\Transaction\Base\ScheduleInterface;
use Ixopay\Client\Transaction\Base\ScheduleTrait;
use Ixopay\Client\Transaction\Base\ThreeDSecureInterface;
use Ixopay\Client\Transaction\Base\ThreeDSecureTrait;

/**
 * Register: Register the customer's payment data for recurring charges.
 *
 * The registered customer payment data will be available for recurring transaction without user interaction.
 *
 * @package Ixopay\Client\Transaction
 */
class Register extends AbstractTransaction
               implements AddToCustomerProfileInterface,
                          CustomerInterface,
                          OffsiteInterface,
                          ScheduleInterface,
                          ThreeDSecureInterface,
                          IndicatorInterface,
                          LevelTwoAndThreeDataInterface
{

    use AddToCustomerProfileTrait;
    use CustomerTrait;
    use OffsiteTrait;
    use ScheduleTrait;
    use ThreeDSecureTrait;
    use PayByLinkTrait;
    use IndicatorTrait;
    use LevelTwoAndThreeDataTrait;

    /** @var string */
    protected $language;

    /** @var string */
    protected $transactionToken;

    /**
     * @var string
     */
    protected $transactionIndicator;

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
}
