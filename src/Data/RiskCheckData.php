<?php

namespace Ixopay\Client\Data;

use Ixopay\Client\Json\DataObject;

/**
 * Class RiskCheckData
 *
 * @package Ixopay\Client\Data
 *
 * @property string riskCheckResult
 * @property int riskScore
 * @property boolean threeDSecureRequired
 *
 * @method string getRiskCheckResult()
 * @method void setRiskCheckResult($value)
 * @method int getRiskScore()
 * @method void setRiskScore($value)
 * @method boolean getThreeDSecureRequired()
 * @method void setThreeDSecureRequired($value)
 */
class RiskCheckData extends DataObject {

}