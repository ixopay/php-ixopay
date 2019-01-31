<?php

namespace Ixopay\Client\Xml;

use Ixopay\Client\Callback\ChargebackData;
use Ixopay\Client\Callback\ChargebackReversalData;
use Ixopay\Client\Data\Customer;
use Ixopay\Client\Data\Result\CreditcardData;
use Ixopay\Client\Data\Result\IbanData;
use Ixopay\Client\Data\Result\PhoneData;
use Ixopay\Client\Data\Result\ResultData;
use Ixopay\Client\Exception\ClientException;
use Ixopay\Client\Schedule\ScheduleResult;
use Ixopay\Client\Exception\InvalidValueException;
use Ixopay\Client\Schedule\ScheduleError;
use Ixopay\Client\StatusApi\StatusResult;
use Ixopay\Client\Transaction\Error;
use Ixopay\Client\Transaction\Result;
use Ixopay\Client\Callback\Result as CallbackResult;

/**
 * Class Parser
 *
 * @package Ixopay\Client\Xml
 */
class Parser {

    /**
     * @param string $xml
     * @return Result
     * @throws InvalidValueException
     */
    public function parseResult($xml) {
        $result = new Result();

        $document = new \DOMDocument('1.0', 'utf-8');
        $document->loadXML($xml);

        $root = $document->getElementsByTagName('result');
        if ($root->length < 0) {
            throw new InvalidValueException('XML does not contain a root "result" element');
        }
        $root = $root->item(0);

        foreach ($root->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            switch ($child->localName) {
                case 'success':
                    if ($child->nodeValue == 'false' || !$child->nodeValue) {
                        $result->setSuccess(false);
                    } else {
                        $result->setSuccess(true);
                    }
                    break;
                case 'purchaseId':
                case 'referenceId':
                case 'registrationId':
                case 'redirectUrl':
                case 'htmlContent':
                case 'paymentDescriptor':
                case 'paymentMethod':
                case 'scheduleId':
                case 'scheduleStatus':
                    if (method_exists($result, 'set'.ucfirst($child->localName))) {
                        $result->{'set' . ucfirst($child->localName)}($child->nodeValue);
                    }
                    break;
                case 'scheduledAt':
                    $scheduleAt = \DateTime::createFromFormat('Y-m-d H:i:s T', $child->nodeValue);
                    $result->setScheduledAt($scheduleAt ?: null);
                    break;
                case 'returnType':
                    $returnType = $this->parseReturnType($child);
                    $result->setReturnType($returnType);
                    if ($returnType == Result::RETURN_TYPE_REDIRECT) {
                        $result->setRedirectType($this->parseRedirectType($child));
                    }
                    break;
                case 'returnData':
                    $result->setReturnData($this->parseReturnData($child));
                    break;
                case 'customerData':
                    $result->setCustomer($this->parseCustomerData($child));
                    break;
                case 'errors':
                    $result->setErrors($this->parseErrors($child));
                    break;
                case 'extraData':
                    list($key, $value) = $this->parseExtraData($child);
                    $result->addExtraData($key, $value);
                    break;
                default:
                    break;
            }
        }

        return $result;

    }

    /**
     * @param string $xml
     * @return CallbackResult
     * @throws InvalidValueException
     */
    public function parseCallback($xml) {
        $result = new CallbackResult();

        $document = new \DOMDocument('1.0', 'utf-8');
        $document->loadXML($xml);

        $root = $document->getElementsByTagName('callback');
        if ($root->length < 0) {
            throw new InvalidValueException('XML does not contain a root "callback" element');
        }
        $root = $root->item(0);

        foreach ($root->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            switch ($child->localName) {
                case 'result':
                    $result->setResult($child->nodeValue);
                    break;
                case 'referenceId':
                    $result->setReferenceId($child->nodeValue);
                    break;
                case 'transactionId':
                    $result->setTransactionId($child->nodeValue);
                    break;
                case 'purchaseId':
                    $result->setPurchaseId($child->nodeValue);
                    break;
                case 'transactionType':
                    $result->setTransactionType($child->nodeValue);
                    break;
                case 'paymentMethod':
                    $result->setPaymentMethod($child->nodeValue);
                    break;
                case 'errors':
                    $result->setErrors($this->parseErrors($child));
                    break;
                case 'extraData':
                    list($key, $value) = $this->parseExtraData($child);
                    $result->addExtraData($key, $value);
                    break;
                case 'merchantMetaData':
                    $result->setMerchantMetaData($child->nodeValue);
                    break;
                case 'chargebackData':
                    $chargebackData = $this->parseChargebackData($child);
                    $result->setChargebackData($chargebackData);
                    break;
                case 'chargebackReversalData':
                    $reversalData = $this->parseChargebackReversalData($child);
                    $result->setChargebackReversalData($reversalData);
                    break;
                case 'returnData':
                    $result->setReturnData($this->parseReturnData($child));
                    break;
                case 'customerData':
                    $result->setCustomer($this->parseCustomerData($child));
                    break;
                case 'amount':
                    $result->setAmount((double)$child->nodeValue);
                    break;
                case 'currency':
                    $result->setCurrency($child->nodeValue);
                    break;
                case 'scheduleId':
                    $result->setScheduleId($child->nodeValue);
                    break;
                case 'scheduleStatus':
                    $result->setScheduleStatus($child->nodeValue);
                    break;
                default:
                    break;
            }
        }

        return $result;
    }

    /**
     * @param string $xml
     * @return StatusResult
     * @throws InvalidValueException
     */
    public function parseStatusResult($xml) {
        $statusResult = new StatusResult();

        $document = new \DOMDocument('1.0', 'utf-8');
        $document->loadXML($xml);

        $root = $document->getElementsByTagName('statusResult');
        if ($root->length < 0) {
            throw new InvalidValueException('XML does not contain a root "statusResult" element');
        }
        $root = $root->item(0);

        foreach ($root->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            switch ($child->localName) {
                case 'operationSuccess':
                    $statusResult->setOperationSuccess($child->nodeValue === 'true' ? true : false);
                    break;
                case 'transactionStatus':
                    $statusResult->setTransactionStatus($child->nodeValue);
                    break;
                case 'transactionUuid':
                    $statusResult->setTransactionUuid($child->nodeValue);
                    break;
                case 'merchantTransactionId':
                    $statusResult->setMerchantTransactionId($child->nodeValue);
                    break;
                case 'purchaseId':
                    $statusResult->setPurchaseId($child->nodeValue);
                    break;
                case 'transactionType':
                    $statusResult->setTransactionType($child->nodeValue);
                    break;
                case 'paymentMethod':
                    $statusResult->setPaymentMethod($child->nodeValue);
                    break;
                case 'errors':
                    $statusResult->setErrors($this->parseErrors($child));
                    break;
                case 'extraData':
                    list($key, $value) = $this->parseExtraData($child);
                    $statusResult->addExtraData($key, $value);
                    break;
                case 'merchantMetaData':
                    $statusResult->setMerchantMetaData($child->nodeValue);
                    break;
                case 'chargebackData':
                    $chargebackData = $this->parseChargebackData($child);
                    $statusResult->setChargebackData($chargebackData);
                    break;
                case 'chargebackReversalData':
                    $reversalData = $this->parseChargebackReversalData($child);
                    $statusResult->setChargebackReversalData($reversalData);
                    break;
                case 'returnData':
                    $statusResult->setReturnData($this->parseReturnData($child));
                    break;
                case 'customerData':
                    $statusResult->setCustomer($this->parseCustomerData($child));
                    break;
                case 'amount':
                    $statusResult->setAmount((double)$child->nodeValue);
                    break;
                case 'currency':
                    $statusResult->setCurrency($child->nodeValue);
                    break;
                default:
                    break;
            }
        }

        return $statusResult;
    }

    /**
     * @param string $xml
     * @return mixed
     * @throws InvalidValueException
     */
    public function parseOptionsResult($xml) {
        $result = array();
        $success = false;
        $error = null;

        $document = new \DOMDocument('1.0', 'utf-8');
        $document->loadXML($xml);

        $root = $document->getElementsByTagName('response');
        if ($root->length < 0) {
            throw new InvalidValueException('XML does not contain a "response" element');
        }
        $root = $root->item(0);

        foreach ($root->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            switch ($child->localName) {
                case 'success':
                    $success = $child->nodeValue == 'true' ? true : false;
                    break;
                case 'error':
                    $error = $child->nodeValue;
                    break;
                case 'parameter':
                    $val = $child->nodeValue;
                    $key = $child->attributes->getNamedItem('name')->nodeValue;
                    if ($val === 'true') {
                        $val = true;
                    } elseif ($val === 'false') {
                        $val = false;
                    } elseif (ctype_digit($val)) {
                        $val = (int)$val;
                    } elseif (is_numeric($val)) {
                        $val = (double)$val;
                    } else {
                        $json = json_decode($val, true);
                        if ($json !== null) {
                            $val = $json;
                        }
                    }
                    $result[$key] = $val;
                    break;
                default:
                    break;
            }
        }

        if ($success == false) {
            throw new ClientException($error);
        }
        if (count($result) === 1 && array_key_exists('undefined', $result)) {
            $result = $result['undefined'];
        }

        return $result;
    }

    /**
     * @param string $xml
     *
     * @return ScheduleResult
     *
     * @throws InvalidValueException
     */
    public function parseScheduleResult($xml) {
        $scheduleResult = new ScheduleResult();

        $document = new \DOMDocument('1.0', 'utf-8');
        $document->loadXML($xml);

        $root = $document->getElementsByTagName('scheduleResult');
        if ($root->length < 0) {
            throw new InvalidValueException('XML does not contain a root "scheduleResult" element');
        }
        $root = $root->item(0);

        foreach ($root->childNodes as $childNode) {
            /**
             * @var \DOMNode $childNode
             */
            switch ($childNode->localName) {
                case 'operationSuccess':
                    if ($childNode->nodeValue == 'false' || !$childNode->nodeValue) {
                        $scheduleResult->setOperationSuccess(false);
                    } else {
                        $scheduleResult->setOperationSuccess(true);
                    }
                    break;
                case 'scheduleId':
                case 'registrationId':
                case 'oldStatus':
                case 'newStatus':
                case 'scheduledAt':
                    if (method_exists($scheduleResult, 'set'.ucfirst($childNode->localName))) {
                        $scheduleResult->{'set' . ucfirst($childNode->localName)}($childNode->nodeValue);
                    }
                    break;
                case 'errors':
                    $scheduleResult->setErrors($this->parseScheduleErrors($childNode));
                    break;
                default:
                    break;
            }
        }

        return $scheduleResult;

    }

    /**
     * @param \DOMNode $node
     * @return string
     * @throws InvalidValueException
     */
    protected function parseReturnType(\DOMNode $node) {
        switch ($node->nodeValue) {
            case 'FINISHED':
                return Result::RETURN_TYPE_FINISHED;
                break;
            case 'REDIRECT':
                return Result::RETURN_TYPE_REDIRECT;
                break;
            case 'HTML':
                return Result::RETURN_TYPE_HTML;
                break;
            case 'PENDING':
                return Result::RETURN_TYPE_PENDING;
                break;
            case 'ERROR':
                return Result::RETURN_TYPE_ERROR;
                break;
            default:
                throw new InvalidValueException('Value "'.$node->nodeValue.'" is not allowed for "returnType"');
                break;
        }
    }

    /**
     * @param \DOMNode $node
     * @return string
     */
    protected function parseRedirectType(\DOMNode $node) {
        if ($node && $node->attributes) {
            $attr = $node->attributes->getNamedItem('redirectType');
            if ($attr) {
                return $attr->nodeValue;
            }
        }
        return null;
    }

    /**
     * @param \DOMNode $node
     * @return ResultData|null
     * @throws InvalidValueException
     */
    protected function parseReturnData(\DOMNode $node) {
        $type = $node->attributes->getNamedItem('type');
        //dd($node->attributes->item(0));
        if (!$type) {
            return null;
        }

        if ($type->firstChild->nodeValue == 'creditcardData') {
            $node = $node->firstChild;
            while($node->nodeName == '#text') {
                $node = $node->nextSibling;
            }
            if ($node->localName != 'creditcardData') {
                throw new InvalidValueException('Expecting element named "creditcardData"');
            }
            $cc = new CreditcardData();
            foreach ($node->childNodes as $child) {
                /**
                 * @var \DOMNode $child
                 */
                switch ($child->localName) {
                    case 'type':
                    case 'firstName':
                    case 'lastName':
                    case 'country':
                    case 'cardHolder':
                    case 'firstSixDigits':
                    case 'lastFourDigits':
                    case 'fingerprint':
                    case 'binBrand':
                    case 'binBank':
                    case 'binType':
                    case 'binLevel':
                    case 'binCountry':
                    case 'threeDSecure':
                    case 'eci':
                        if (method_exists($cc, 'set'.ucfirst($child->localName))) {
                            $cc->{'set' . ucfirst($child->localName)}($child->nodeValue);
                        }
                        break;
                    case 'expiryMonth':
                    case 'expiryYear':
                        if (method_exists($cc, 'set'.ucfirst($child->localName))) {
                            $cc->{'set' . ucfirst($child->localName)}((int)$child->nodeValue);
                        }
                        break;
                    default:
                        break;
                }
            }
            return $cc;
        } elseif ($type->firstChild->nodeValue == 'phoneData') {
            $node = $node->firstChild;
            while($node->nodeName == '#text') {
                $node = $node->nextSibling;
            }
            if ($node->localName != 'phoneData') {
                throw new InvalidValueException('Expecting element named "phoneData"');
            }
            $phone = new PhoneData();
            foreach ($node->childNodes as $child) {
                /**
                 * @var \DOMNode $child
                 */
                switch ($child->localName) {
                    case 'phoneNumber':
                        $phone->setPhoneNumber($child->nodeValue);
                        break;
                    case 'operator':
                        $phone->setOperator($child->nodeValue);
                        break;
                    case 'country':
                        $phone->setCountry($child->nodeValue);
                        break;
                    default:
                        break;
                }
            }
            return $phone;
        } elseif ($type->firstChild->nodeValue == 'ibanData') {
            $node = $node->firstChild;
            while($node->nodeName == '#text') {
                $node = $node->nextSibling;
            }
            if ($node->localName != 'ibanData') {
                throw new InvalidValueException('Expecting element named "ibanData"');
            }
            $ibanData = new IbanData();
            foreach ($node->childNodes as $child) {
                /**
                 * @var \DOMNode $child
                 */
                switch ($child->localName) {
                    case 'accountOwner':
                        $ibanData->setAccountOwner($child->nodeValue);
                        break;
                    case 'iban':
                        $ibanData->setIban($child->nodeValue);
                        break;
                    case 'bic':
                        $ibanData->setBic($child->nodeValue);
                        break;
                    case 'bankName':
                        $ibanData->setBankName($child->nodeValue);
                        break;
                    case 'country':
                        $ibanData->setCountry($child->nodeValue);
                        break;
                    default:
                        break;
                }
            }
            return $ibanData;
        }
        return null;
    }

    /**
     * @param \DOMNode $node
     * @return Error[]
     * @throws InvalidValueException
     */
    protected function parseErrors(\DOMNode $node) {
        $errors = array();

        foreach ($node->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            if ($child->nodeName == '#text') {
                continue;
            }
            if ($child->localName != 'error') {
                throw new InvalidValueException('Expecting element named "error"');
            }
            $message = $code = $adapterMessage = $adapterCode = null;
            foreach ($child->childNodes as $c) {
                /**
                 * @var \DOMNode $c
                 */
                switch ($c->localName) {
                    case 'message':
                        $message = $c->nodeValue;
                        break;
                    case 'code':
                        $code = $c->nodeValue;
                        break;
                    case 'adapterMessage':
                        $adapterMessage = $c->nodeValue;
                        break;
                    case 'adapterCode':
                        $adapterCode = $c->nodeValue;
                        break;
                    default:
                        break;
                }
            }

            $error = new Error($message, $code, $adapterMessage, $adapterCode);
            $errors[] = $error;

        }
        return $errors;
    }

    /**
     * @param \DOMNode $node
     *
     * @return ScheduleError[]
     *
     * @throws InvalidValueException
     */
    protected function parseScheduleErrors(\DOMNode $node) {
        $errors = array();

        foreach ($node->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            if ($child->nodeName == '#text') {
                continue;
            }
            if ($child->localName != 'error') {
                throw new InvalidValueException('Expecting element named "error"');
            }
            $message = $code = null;
            foreach ($child->childNodes as $childNode) {
                /**
                 * @var \DOMNode $childNode
                 */
                switch ($childNode->localName) {
                    case 'message':
                        $message = $childNode->nodeValue;
                        break;
                    case 'code':
                        $code = $childNode->nodeValue;
                        break;
                    default:
                        break;
                }
            }

            $error = new ScheduleError($message, $code);
            $errors[] = $error;

        }
        return $errors;
    }

    /**
     * @param \DOMNode $node
     * @return array
     */
    protected function parseExtraData(\DOMNode $node) {
        $key = $node->attributes->getNamedItem('key')->nodeValue;
        $value = $node->nodeValue;

        return array($key, $value);
    }

    /**
     * @param \DOMNode $node
     * @return ChargebackData
     */
    protected function parseChargebackData(\DOMNode $node) {
        $data = new ChargebackData();

        foreach ($node->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            if ($child->nodeName == '#text' || empty($child->nodeValue)) {
                continue;
            }
            switch ($child->localName) {
                case 'originalReferenceId':
                    $data->setOriginalReferenceId($child->nodeValue);
                    break;
                case 'originalTransactionId':
                    $data->setOriginalTransactionId($child->nodeValue);
                    break;
                case 'amount':
                    $data->setAmount((double)$child->nodeValue);
                    break;
                case 'currency':
                    $data->setCurrency($child->nodeValue);
                    break;
                case 'chargebackDateTime':
                    $data->setChargebackDateTime(new \DateTime($child->nodeValue));
                    break;
                case 'reason':
                    $data->setReason($child->nodeValue);
                    break;
                default:
                    break;
            }
        }

        return $data;
    }

    /**
     * @param \DOMNode $node
     * @return ChargebackReversalData
     */
    protected function parseChargebackReversalData(\DOMNode $node) {
        $data = new ChargebackReversalData();

        foreach ($node->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            if ($child->nodeName == '#text' || empty($child->nodeValue)) {
                continue;
            }
            switch ($child->localName) {
                case 'originalReferenceId':
                    $data->setOriginalReferenceId($child->nodeValue);
                    break;
                case 'originalTransactionId':
                    $data->setOriginalTransactionId($child->nodeValue);
                    break;
                case 'chargebackReferenceId':
                    $data->setChargebackReferenceId($child->nodeValue);
                    break;
                case 'amount':
                    $data->setAmount((double)$child->nodeValue);
                    break;
                case 'currency':
                    $data->setCurrency($child->nodeValue);
                    break;
                case 'reversalDateTime':
                    $data->setReversalDateTime(new \DateTime($child->nodeValue));
                    break;
                case 'reason':
                    $data->setReason($child->nodeValue);
                    break;
                default:
                    break;
            }
        }

        return $data;
    }

    /**
     * @param \DOMNode $node
     * @return Customer
     */
    protected function parseCustomerData(\DOMNode $node) {
        $customer = new Customer();

        foreach ($node->childNodes as $child) {
            /**
             * @var \DOMNode $child
             */
            if ($child->nodeName == '#text' || empty($child->nodeValue)) {
                continue;
            }
            switch ($child->localName) {
                case 'identification':
                case 'firstName':
                case 'lastName':
                case 'gender':
                case 'birthDate':
                case 'billingAddress1':
                case 'billingAddress2':
                case 'billingCity':
                case 'billingPostcode':
                case 'billingState':
                case 'billingCountry':
                case 'billingPhone':
                case 'shippingFirstName':
                case 'shippingLastName':
                case 'shippingCompany':
                case 'shippingAddress1':
                case 'shippingAddress2':
                case 'shippingCity':
                case 'shippingPostcode':
                case 'shippingState':
                case 'shippingCountry':
                case 'shippingPhone':
                case 'company':
                case 'email':
                case 'ipAddress':
                case 'nationalId':
                    if (method_exists($customer, 'set'.ucfirst($child->localName))) {
                        $customer->{'set' . ucfirst($child->localName)}($child->nodeValue);
                    }
                    break;
                case 'emailVerified':
                    $customer->setEmailVerified($customer->isEmailVerified() === 'true' ? true : false);
                    break;
                default:
                    break;
            }
        }

        return $customer;
    }
}