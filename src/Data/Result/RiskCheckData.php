<?php

namespace Ixopay\Client\Data\Result;

/**
 * Class RiskCheckData
 *
 * @package Ixopay\Client\Data\Result
 */
class RiskCheckData extends ResultData {

    const RESULT_APPROVED = 'APPROVED';
    const RESULT_DECLINED = 'DECLINED';
    const RESULT_REVIEW = 'REVIEW';

    const THREE_D_REQUIRED_NONE = 'NONE';
    const THREE_D_REQUIRED_OPTIONAL = 'OPTIONAL';
    const THREE_D_REQUIRED_MANDATORY = 'MANDATORY';

    /**
     * @var string
     */
    protected $result;

    /**
     * @var int
     */
    protected $riskScore;

    /**
     * @var
     */
    protected $threeDSecureRequired = self::THREE_D_REQUIRED_NONE;

    /**
     * @return string
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * @param string $result
     *
     * @return RiskCheckData
     */
    public function setResult($result) {
        $this->result = $result;

        return $this;
    }

    /**
     * @return int
     */
    public function getRiskScore() {
        return $this->riskScore;
    }

    /**
     * @param int $riskScore
     *
     * @return RiskCheckData
     */
    public function setRiskScore($riskScore) {
        $this->riskScore = $riskScore;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getThreeDSecureRequired() {
        return $this->threeDSecureRequired;
    }

    /**
     * @param mixed $threeDSecureRequired
     *
     * @return RiskCheckData
     */
    public function setThreeDSecureRequired($threeDSecureRequired) {
        $this->threeDSecureRequired = $threeDSecureRequired;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray() {
        return array(
            'result' => $this->result,
            'riskScore' => $this->riskScore,
            'threeDSecureRequired' => $this->threeDSecureRequired
        );
    }
}