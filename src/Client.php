<?php

namespace Ixopay\Client;

use Ixopay\Client\CustomerProfile\CustomerData;
use Ixopay\Client\CustomerProfile\DeleteProfileResponse;
use Ixopay\Client\CustomerProfile\GetProfileResponse;
use Ixopay\Client\CustomerProfile\PaymentInstrument;
use Ixopay\Client\CustomerProfile\UpdateProfileResponse;
use Ixopay\Client\Exception\TypeException;
use Ixopay\Client\Json\ErrorResponse;
use Ixopay\Client\Exception\RateLimitException;
use Ixopay\Client\Json\JsonParser;
use Ixopay\Client\Options\OptionsResult;
use Ixopay\Client\Schedule\ScheduleData;
use Ixopay\Client\Exception\ClientException;
use Ixopay\Client\Exception\InvalidValueException;
use Ixopay\Client\Exception\TimeoutException;
use Ixopay\Client\Http\CurlClient;
use Ixopay\Client\Http\Response;
use Ixopay\Client\Schedule\StartSchedule;
use Ixopay\Client\StatusApi\StatusRequestData;
use Ixopay\Client\Transaction\Base\AbstractTransaction;
use Ixopay\Client\Transaction\Capture;
use Ixopay\Client\Transaction\Debit;
use Ixopay\Client\Transaction\Deregister;
use Ixopay\Client\Transaction\Payout;
use Ixopay\Client\Transaction\Preauthorize;
use Ixopay\Client\Transaction\Refund;
use Ixopay\Client\Transaction\Register;
use Ixopay\Client\Transaction\Result;
use Ixopay\Client\Transaction\VoidTransaction;
use Ixopay\Client\Json\JsonGenerator;
use Ixopay\Client\Xml\XmlGenerator;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class Client
 *
 * @package Ixopay\Client
 */
class Client {

    /**
     * The default url points to the IxoPay Gateway
     */
    const DEFAULT_IXOPAY_URL = 'https://gateway.ixopay.com/';

    /** @deprecated for xml only */
    const TRANSACTION_ROUTE = 'transaction';
    /** @deprecated for xml only */
    const SCHEDULE_ROUTE = 'schedule';
    /** @deprecated for xml only */
    const STATUS_ROUTE = 'status';
    /** @deprecated for xml only */
    const OPTIONS_ROUTE = 'options';

    const SCHEDULE_ACTION_START = 'startSchedule';

    const SCHEDULE_ACTION_SHOW = 'showSchedule';

    const SCHEDULE_ACTION_PAUSE = 'pauseSchedule';

    const SCHEDULE_ACTION_CONTINUE = 'continueSchedule';

    const SCHEDULE_ACTION_CANCEL = 'cancelSchedule';

    /* json endpoints */

    const CUSTOMER_PROFILE_GET = 'api/v3/customerProfiles/[API_KEY]/getProfile';
    const CUSTOMER_PROFILE_UPDATE = 'api/v3/customerProfiles/[API_KEY]/updateProfile';
    const CUSTOMER_PROFILE_DELETE = 'api/v3/customerProfiles/[API_KEY]/deleteProfile';

    const TRANSACTION_DEBIT = 'api/v3/transaction/[API_KEY]/debit';
    const TRANSACTION_PREAUTHORIZE = 'api/v3/transaction/[API_KEY]/preauthorize';
    const TRANSACTION_CAPTURE = 'api/v3/transaction/[API_KEY]/capture';
    const TRANSACTION_VOID = 'api/v3/transaction/[API_KEY]/void';
    const TRANSACTION_REGISTER = 'api/v3/transaction/[API_KEY]/register';
    const TRANSACTION_DEREGISTER = 'api/v3/transaction/[API_KEY]/deregister';
    const TRANSACTION_REFUND = 'api/v3/transaction/[API_KEY]/refund';
    const TRANSACTION_PAYOUT = 'api/v3/transaction/[API_KEY]/payout';

    const STATUS_BY_UUID = 'api/v3/status/[API_KEY]/getByUuid/{uuid}';
    const STATUS_BY_MERCHANT_TRANSACTION_ID = 'api/v3/status/[API_KEY]/getByMerchantTransactionId/{merchantTransactionId}';

    const SCHEDULE_START = 'api/v3/schedule/[API_KEY]/start';
    const SCHEDULE_GET = 'api/v3/schedule/[API_KEY]/{scheduleId}/get';
    const SCHEDULE_PAUSE = 'api/v3/schedule/[API_KEY]/{scheduleId}/pause';
    const SCHEDULE_CONTINUE = 'api/v3/schedule/[API_KEY]/{scheduleId}/continue';
    const SCHEDULE_CANCEL = 'api/v3/schedule/[API_KEY]/{scheduleId}/cancel';

    const OPTIONS_REQUEST = 'api/v3/options/[API_KEY]/{optionsName}';

    /**
     * @var string
     */
    protected static $gatewayUrl = 'https://gateway.ixopay.com/';

    /**
     * the api key given by the ixopay gateway
     *
     * @var string
     */
    protected $apiKey;

    /**
     * the shared secret belonging to the api key
     *
     * @var string
     */
    protected $sharedSecret;

    /**
     * authentication username of an API user
     *
     * @var string
     */
    protected $username;

    /**
     * authentication password of an API user
     *
     * @var string
     */
    protected $password;

    /**
     * language you want to use (optional)
     *
     * @var string
     */
    protected $language;

    /**
     * @deprecated not in use anymore
     *
     * set to true if you want to perform a test transaction
     *
     * @var bool
     */
    protected $testMode;

	/**
	 * @var LoggerInterface
	 */
    protected $logger;

    /**
     * @var JsonGenerator
     */
    protected $generator;

    /**
     * @param string $username
     * @param string $password
     * @param string $apiKey
     * @param string $sharedSecret
     * @param string $language
     * @param bool   $testMode - DEPRECATED
     */
    public function __construct($username, $password, $apiKey, $sharedSecret, $language = null, $testMode = false) {
        $this->username = $username;
        $this->setPassword($password);
        $this->apiKey = $apiKey;
        $this->sharedSecret = $sharedSecret;
        $this->language = $language;
        $this->testMode = $testMode;
    }

	/**
	 * Set a Logger instance
	 * @param LoggerInterface $logger
	 * @return $this
	 */
    public function setLogger(LoggerInterface $logger) {
    	$this->logger = $logger;
    	return $this;
    }

	/**
     * Logs with an arbitrary level if we have a logger set
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = array()) {
    	if ($this->logger && $this->logger instanceof LoggerInterface) {
    		$this->logger->log($level, $message, $context);
    	}
    	//dev/null
    }

    /**
     * build and send JSON request from given Transaction Object
     *
     * @param                     $transactionMethod
     * @param AbstractTransaction $transaction
     *
     * @return Result
     *
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    protected function sendTransaction($transactionMethod, AbstractTransaction $transaction) {
        $json = $this->getGenerator()->generateTransaction($transactionMethod, $transaction, $this->language);

        $endpoint = '';

        switch($transactionMethod){
            case 'register':
                $endpoint .= self::TRANSACTION_REGISTER;
                break;
            case 'deregister':
                $endpoint .= self::TRANSACTION_DEREGISTER;
                break;
            case 'preauthorize':
                $endpoint .= self::TRANSACTION_PREAUTHORIZE;
                break;
            case 'void':
                $endpoint .= self::TRANSACTION_VOID;
                break;
            case 'capture':
                $endpoint .= self::TRANSACTION_CAPTURE;
                break;
            case 'refund':
                $endpoint .= self::TRANSACTION_REFUND;
                break;
            case 'debit':
                $endpoint .= self::TRANSACTION_DEBIT;
                break;
            case 'payout':
                $endpoint .= self::TRANSACTION_PAYOUT;
                break;
        }

        $endpoint = str_replace('[API_KEY]', $this->getApiKey(), $endpoint);
        $httpResponse = $this->sendJsonApiRequest($endpoint, $json);

        return $this->getParser()->parseTransactionResult($httpResponse->getBody());
    }

    /**
     * either pass ScheduleData object OR StartSchedule object
     *
     * @param ScheduleData|StartSchedule $scheduleData
     *
     * @return Schedule\ScheduleResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function startSchedule($scheduleData) {
        return $this->sendScheduleRequest(self::SCHEDULE_ACTION_START, $scheduleData);
    }

    /**
     * either pass ScheduleData OR scheduleId
     *
     * @param ScheduleData|string $scheduleData
     *
     * @return Schedule\ScheduleResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function showSchedule($scheduleData) {
        return $this->sendScheduleRequest(self::SCHEDULE_ACTION_SHOW, $scheduleData);
    }

    /**
     * either pass ScheduleData OR scheduleId
     *
     * @param ScheduleData|string $scheduleData
     *
     * @return Schedule\ScheduleResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function pauseSchedule($scheduleData) {
        return $this->sendScheduleRequest(self::SCHEDULE_ACTION_PAUSE, $scheduleData);
    }

    /**
     * either pass ScheduleData object OR scheduleId + continueDateTime
     *
     * @param ScheduleData|string $scheduleData
     * @param \DateTime|null      $continueDateTime
     *
     * @return Schedule\ScheduleResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function continueSchedule($scheduleData, \DateTime $continueDateTime=null) {
        return $this->sendScheduleRequest(self::SCHEDULE_ACTION_CONTINUE, [$scheduleData, $continueDateTime]);
    }

    /**
     * either pass ScheduleData OR scheduleId
     *
     * @param ScheduleData|string $scheduleData
     *
     * @return Schedule\ScheduleResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function cancelSchedule($scheduleData) {
        return $this->sendScheduleRequest(self::SCHEDULE_ACTION_CANCEL, $scheduleData);
    }

    /**
     * backwards compatible via ScheduleResultData
     * => in future only the new params should be supported:
     *  - StartSchedule (obj): used to start a schedule
     *  - array [scheduleId, continueDateTime]: used to continue schedule
     *  - string [scheduleId]: used to show, pause or cancel a schedule
     *
     * @param string                                      $action
     * @param ScheduleData|StartSchedule|string|array     $scheduleData
     *
     * @return Schedule\ScheduleResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function sendScheduleRequest($action, $scheduleData) {
        $json = $this->getGenerator()->generateSchedule($action, $scheduleData);

        switch($action){
            case self::SCHEDULE_ACTION_START:
                $endpoint = self::SCHEDULE_START;
                break;
            case self::SCHEDULE_ACTION_SHOW:
                $endpoint = self::SCHEDULE_GET;
                break;
            case self::SCHEDULE_ACTION_PAUSE:
                $endpoint = self::SCHEDULE_PAUSE;
                break;
            case self::SCHEDULE_ACTION_CONTINUE:
                $endpoint = self::SCHEDULE_CONTINUE;
                break;
            case self::SCHEDULE_ACTION_CANCEL:
                $endpoint = self::SCHEDULE_CANCEL;
                break;
            default:
                throw new TypeException('Invalid schedule action');
        }

        //all schedule actions endpoints contain the scheduleId except 'schedule start'
        if($action !== self::SCHEDULE_ACTION_START) {

            //backwards compatible
            if ($scheduleData instanceof ScheduleData) {
                $endpoint = str_replace('{scheduleId}', $scheduleData->getScheduleId(), $endpoint);
            } elseif (is_array($scheduleData)) {
                //continueSchedule [id, datetime]
                $endpoint = str_replace('{scheduleId}', $scheduleData[0], $endpoint);
            } elseif (is_string($scheduleData)) {
                $endpoint = str_replace('{scheduleId}', $scheduleData, $endpoint);
            }

        }

        if($action !== self::SCHEDULE_ACTION_SHOW) {
            $httpResponse = $this->sendJsonApiRequest($endpoint, $json);
        } else{
            $httpResponse = $this->sendJsonApiRequest($endpoint);
        }

        return $this->getParser()->parseScheduleResult($httpResponse->getBody());
    }

    /**
     * @param StatusRequestData $statusRequestData
     *
     * @return StatusApi\StatusResult
     * @throws ClientException
     * @throws Exception\TypeException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function sendStatusRequest(StatusRequestData $statusRequestData) {

        if($statusRequestData->getUuid()){
            $endpoint = self::STATUS_BY_UUID;
            $endpoint = str_replace('{uuid}', $statusRequestData->getUuid(), $endpoint);
        } elseif($statusRequestData->getMerchantTransactionId()){
            $endpoint = self::STATUS_BY_MERCHANT_TRANSACTION_ID;
            $endpoint = str_replace('{merchantTransactionId}', $statusRequestData->getMerchantTransactionId(), $endpoint);
        } else{
            throw new TypeException('Either transactionUuid or merchantTransactionId is required!');
        }

        $httpResponse = $this->sendJsonApiRequest($endpoint);

        return $this->getParser()->parseStatusResult($httpResponse->getBody());
    }

    /**
     * @param array $dataArray
     * @param string $path
     * @return Response
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    protected function sendJsonApiRequest($path, $dataArray=null) {

        $url = self::$gatewayUrl . $path;

        $body = $dataArray ? json_encode($dataArray) : null;

        $httpResponse = $this->signAndSendJson($body, $url, $this->username, $this->password, $this->apiKey, $this->sharedSecret);

        $statusCode = $httpResponse->getStatusCode();

        if ($statusCode === 504 || $statusCode === 522) {
            throw new TimeoutException('Request timed-out');
        }
        if ($httpResponse->getErrorCode() || $httpResponse->getErrorMessage()) {
            throw new ClientException('Request failed: ' . $httpResponse->getErrorCode() . ' ' . $httpResponse->getErrorMessage());
        }

        return $httpResponse;
    }

    /**
     * @param string[] $compareValues
     * @param string   $subject
     *
     * @return bool
     */
    protected function startsWith(array $compareValues, $subject) {
        $firstLetter = substr( $subject, 0, 1 );
        foreach($compareValues as $compareValue) {
            if ($firstLetter == $compareValue) {
                return true;
            }
        }

        return false;
    }

    /**
     * @deprecated use signAndSendJson()
     *
     * signs and send a well-formed transaction xml
     *
     * @param string $xml
     * @param string $apiKey
     * @param string $sharedSecret
     * @param string $url
     *
     * @return Response
     * @throws Http\Exception\ClientException
     */
    public function signAndSendXml($xml, $apiKey, $sharedSecret, $url) {
		$this->log(LogLevel::DEBUG, "POST $url ",
			array(
				'url' => $url,
				'xml' => $xml,
				'apiKey' => $apiKey,
				'sharedSecret' => $sharedSecret,
			)
		);

        $curl = new CurlClient();
        $response = $curl
        	->sign($apiKey, $sharedSecret, $url, $xml)
            ->post($url, $xml);

		$this->log(LogLevel::DEBUG, "RESPONSE: " . $response->getBody(),
			array(
				'response' => $response
			)
		);

		return $response;
    }

    /**
     * signs and send a json POST request
     *
     * @param        $jsonBody
     * @param string $url
     *
     * @param string $username
     * @param string $password
     * @param string $apiKey
     * @param string $sharedSecret
     *
     * @return Response
     * @throws Http\Exception\ClientException
     */
    public function signAndSendJson($jsonBody, $url, $username, $password, $apiKey, $sharedSecret) {
        $url = str_replace('[API_KEY]', $apiKey, $url);

        // no body = get
        $type = $jsonBody ? 'POST' : 'GET';

        $this->log(LogLevel::DEBUG, "{$type} $url ",
            array(
                'url' => $url,
                'json' => $jsonBody,
                'apiKey' => $apiKey,
                'sharedSecret' => $sharedSecret,
            )
        );

        $curl = new CurlClient();
        $curl->signJson($sharedSecret, $url, $jsonBody, $type)
             ->setAuthentication($username, $password);

        if($jsonBody){
            $response = $curl->post($url, $jsonBody);
        } else{
            $response = $curl->get($url);
        }

        $this->log(LogLevel::DEBUG, "RESPONSE: " . $response->getBody(),
            array(
                'response' => $response
            )
        );

        return $response;
    }

    /**
     * register a new user vault
     *
     * NOTE: not all payment methods support this function
     *
     * @param Register $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     */
    public function register(Register $transactionData) {
        return $this->sendTransaction('register', $transactionData);
    }

    /**
     * deregister a previously registered user vault
     *
     * NOTE: not all payment methods support this function
     *
     * @param Deregister $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     */
    public function deregister(Deregister $transactionData) {
        return $this->sendTransaction('deregister', $transactionData);
    }

    /**
     * preauthorize a transaction
     *
     * NOTE: not all payment methods support this function
     *
     * @param Preauthorize $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     */
    public function preauthorize(Preauthorize $transactionData) {
        return $this->sendTransaction('preauthorize', $transactionData);
    }

    /**
     * void a previously preauthorized transaction
     *
     * @param VoidTransaction $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     */
    public function void(VoidTransaction $transactionData) {
        return $this->sendTransaction('void', $transactionData);
    }

    /**
     * capture a previously preauthorized transaction
     *
     * @param Capture $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     */
    public function capture(Capture $transactionData) {
        return $this->sendTransaction('capture', $transactionData);
    }

    /**
     * refund a performed debit/capture
     *
     * @param Refund $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     */
    public function refund(Refund $transactionData) {
        return $this->sendTransaction('refund', $transactionData);
    }

    /**
     * perform a debit
     *
     * @param Debit $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     */
    public function debit(Debit $transactionData) {
        return $this->sendTransaction('debit', $transactionData);
    }

    /**
     * perform a payout transaction (credit the customer)
     *
     * @param Payout $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function payout(Payout $transactionData) {
        return $this->sendTransaction('payout', $transactionData);
    }

    /**
     * returns a list of options
     * optionally parameters can be passed depending on the connector
     *
     * @param string $identifier
     * @param array  $parameters [optional]
     * @param        $_ [deprecated]
     *
     * @return OptionsResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     */
    public function getOptions($identifier, $parameters = [], $_ = null) {
        $endpoint = self::OPTIONS_REQUEST;
        $endpoint = str_replace('{optionsName}', $identifier, $endpoint);

        $httpResponse = $this->sendJsonApiRequest($endpoint, ['parameters' => $parameters]);

        return $this->getParser()->parseOptionsResult($httpResponse->getBody());
    }

    /**
     * parses the callback notification xml and returns a Result object
     * you SHOULD verify the callback first by using $this->validateCallback();
     *
     * @param string $requestBody
     *
     * @return Callback\Result
     * @throws \Exception
     */
    public function readCallback($requestBody) {
        return $this->getParser()->parseCallback($requestBody);
    }

    /**
     * validates if the received callback notification is properly signed
     *
     * @param string $requestBody         - the raw xml body of the received request
     * @param string $requestQuery        - the query part of your receiving script, e.g.
     *                                    "/callback_receive.php?someId=0815" (without the hostname and with the
     *                                    leading slash and all query parameters)
     * @param        $dateHeader          - value of the header field "Date"
     * @param        $authorizationHeader - value of the header field "Authorization"
     *
     * @return bool - true if the signature is correct
     */
    public function validateCallback($requestBody, $requestQuery, $dateHeader, $authorizationHeader) {
        $curl = new CurlClient();
        $digest = $curl->createSignature($this->getSharedSecret(), 'POST', $requestBody, 'text/xml; charset=utf-8',
            $dateHeader, $requestQuery);
        $expectedSig = 'IxoPay ' . $this->getApiKey() . ':' . $digest;
        $expectedSig2 = 'Gateway '.$this->getApiKey() . ':' . $digest;


        if (strpos($authorizationHeader, 'Authorization:') !== false) {
            $authorizationHeader = trim(str_replace('Authorization:', '', $authorizationHeader));
        }

        if ($authorizationHeader === $expectedSig || $authorizationHeader === $expectedSig2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * validate callback by retrieving parameters from PHP GLOBALS
     *
     * @return bool
     */
    public function validateCallbackWithGlobals() {
        $requestBody = file_get_contents('php://input');
        $requestQuery = $_SERVER['REQUEST_URI'];
        if (!empty($_SERVER['HTTP_DATE'])) {
            $dateHeader = $_SERVER['HTTP_DATE'];
        } elseif (!empty($_SERVER['HTTP_X_DATE'])) {
            $dateHeader = $_SERVER['HTTP_X_DATE'];
        } else {
            $dateHeader = null;
        }

        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $authorizationHeader = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (!empty($_SERVER['HTTP_X_AUTHORIZATION'])) {
            $authorizationHeader = $_SERVER['HTTP_X_AUTHORIZATION'];
        } else {
            $authorizationHeader = null;
        }


        return $this->validateCallback($requestBody, $requestQuery, $dateHeader, $authorizationHeader);
    }

    /**
     * retrieves customer profile by profile-guid
     *
     * @param string $profileGuid
     * @return GetProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function getCustomerProfileByProfileGuid($profileGuid) {
        $requestData = array(
            'profileGuid' => $profileGuid
        );

        $response = $this->sendJsonApiRequest(self::CUSTOMER_PROFILE_GET, $requestData);
        $json = json_decode($response->getBody());
        if ($response->getStatusCode() == 200 && $json && ($json->success || isset($json->profileExists))) {
            $result = new GetProfileResponse();
            $result->_populateFromResponse($json);
            return $result;
        } elseif ($json && !$json->success) {
            $result = new ErrorResponse();
            $result->_populateFromResponse($json);
            return $result;
        }

        throw new ClientException('Invalid response received: '.$response->getBody());
    }

    /**
     * retrieves customer profile by customer identification
     *
     * @param string $customerIdentification
     * @return GetProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function getCustomerProfileByIdentification($customerIdentification) {
        $requestData = array(
            'customerIdentification' => $customerIdentification
        );

        $response = $this->sendJsonApiRequest(self::CUSTOMER_PROFILE_GET, $requestData);
        $json = json_decode($response->getBody());
        if ($response->getStatusCode() == 200 && $json && ($json->success || isset($json->profileExists))) {
            $result = new GetProfileResponse();
            $result->_populateFromResponse($json);
            return $result;
        } elseif ($json && !$json->success) {
            $result = new ErrorResponse();
            $result->_populateFromResponse($json);
            return $result;
        }

        throw new ClientException('Invalid response received: '.$response->getBody());
    }

    /**
     * updates customer profile by profile-guid
     *
     * @param string                        $profileGuid
     * @param CustomerData                  $customerData
     * @param string|PaymentInstrument|null $preferredInstrument
     *
     * @return ErrorResponse|UpdateProfileResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function updateCustomerProfileByProfileGuid($profileGuid, CustomerData $customerData, $preferredInstrument = null) {
        $requestData = array(
            'profileGuid' => $profileGuid,
            'customerData' => $customerData->toArray()
        );
        if ($preferredInstrument !== null) {
            if ($preferredInstrument instanceof PaymentInstrument) {
                $requestData['preferredInstrument'] = $preferredInstrument->paymentToken;
            } else {
                $requestData['preferredInstrument'] = $preferredInstrument;
            }

        }

        $response = $this->sendJsonApiRequest(self::CUSTOMER_PROFILE_UPDATE, $requestData);
        $json = json_decode($response->getBody());
        if ($response->getStatusCode() == 200 && $json && $json->success) {
            $result = new UpdateProfileResponse();
            $result->_populateFromResponse($json);
            return $result;
        } elseif ($json && !$json->success) {
            $result = new ErrorResponse();
            $result->_populateFromResponse($json);
            return $result;
        }

        throw new ClientException('Invalid response received: '.$response->getBody());

    }

    /**
     * updates customer profile by customer identification
     *
     * @param string                        $customerIdentification
     * @param CustomerData                  $customerData
     * @param string|PaymentInstrument|null $preferredInstrument
     *
     * @return UpdateProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function updateCustomerProfileByIdentification($customerIdentification, CustomerData $customerData, $preferredInstrument = null) {
        $requestData = array(
            'customerIdentification' => $customerIdentification,
            'customerData' => $customerData->toArray()
        );
        if ($preferredInstrument !== null) {
            if ($preferredInstrument instanceof PaymentInstrument) {
                $requestData['preferredInstrument'] = $preferredInstrument->paymentToken;
            } else {
                $requestData['preferredInstrument'] = $preferredInstrument;
            }

        }

        $response = $this->sendJsonApiRequest(self::CUSTOMER_PROFILE_UPDATE, $requestData);
        $json = json_decode($response->getBody());
        if ($response->getStatusCode() == 200 && $json && $json->success) {
            $result = new UpdateProfileResponse();
            $result->_populateFromResponse($json);
            return $result;
        } elseif ($json && !$json->success) {
            $result = new ErrorResponse();
            $result->_populateFromResponse($json);
            return $result;
        }

        throw new ClientException('Invalid response received: '.$response->getBody());
    }

    /**
     * deletes customer profile by profile-guid
     *
     * @param $profileGuid
     * @return DeleteProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function deleteCustomerProfileByProfileGuid($profileGuid) {
        $requestData = array(
            'profileGuid' => $profileGuid,
        );


        $response = $this->sendJsonApiRequest(self::CUSTOMER_PROFILE_DELETE, $requestData);
        $json = json_decode($response->getBody());
        if ($response->getStatusCode() == 200 && $json && $json->success) {
            $result = new DeleteProfileResponse();
            $result->_populateFromResponse($json);
            return $result;
        } elseif ($json && !$json->success) {
            $result = new ErrorResponse();
            $result->_populateFromResponse($json);
            return $result;
        }


        throw new ClientException('Invalid response received: '.$response->getBody());
    }

    /**
     * deletes customer profile by customer identification
     *
     * @param $customerIdentification
     * @return DeleteProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     */
    public function deleteCustomerProfileByIdentification($customerIdentification) {
        $requestData = array(
            'customerIdentification' => $customerIdentification,
        );

        $response = $this->sendJsonApiRequest(self::CUSTOMER_PROFILE_DELETE, $requestData);
        $json = json_decode($response->getBody());
        if ($response->getStatusCode() == 200 && $json && $json->success) {
            $result = new DeleteProfileResponse();
            $result->_populateFromResponse($json);
            return $result;
        } elseif ($json && !$json->success) {
            $result = new ErrorResponse();
            $result->_populateFromResponse($json);
            return $result;
        }


        throw new ClientException('Invalid response received: '.$response->getBody());
    }

    /**
     * @return string
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getSharedSecret() {
        return $this->sharedSecret;
    }

    /**
     * @param string $sharedSecret
     *
     * @return $this
     */
    public function setSharedSecret($sharedSecret) {
        $this->sharedSecret = $sharedSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password) {
        $this->password = $this->hashPassword($password);
        return $this;
    }

    /**
     * set the hashed password
     *
     * @param string $password
     * @return $this
     */
    public function setHashedPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage($language) {
        $this->language = $language;
        return $this;
    }

    /**
     * @return JsonGenerator
     */
    public function getGenerator() {
        if (!$this->generator) {
            $this->generator = new JsonGenerator();
        }
        return $this->generator;
    }

    /**
     * @param string $namespaceRoot
     */
    public function setNamespaceRoot($namespaceRoot) {
        $this->getGenerator()->setNamespaceRoot($namespaceRoot);
    }

    /**
     * @return JsonParser
     */
    protected function getParser() {
        return new JsonParser();
    }

    /**
     * @param string $password
     *
     * @return string
     */
    private function hashPassword($password) {
        for ($i = 0; $i < 10; $i++) {
            $password = sha1($password);
        }
        return $password;
    }

    /**
     * Sets the IxoPay Gateway url (API URL) to the given one. This allows to set up a development/test environment.
     * The API url is already set to the proper value by default.
     *
     * Please note that setting the API URL affects all instances (including the existing ones) of this client.
     *
     * DO NOT MODIFY THE API URL IN PRODUCTION ENVIRONMENT IF IT IS NOT NECESSARY TO PREVENT UNEXPECTED BEHAVIOUR!
     *
     * @param string $url   The URL to use to send the requests to.
     *
     * @return void
     *
     * @throws InvalidValueException
     *
     * @internal
     */
    public static function setApiUrl($url) {
        if (empty($url)) {
            throw new InvalidValueException('The URL to the IxoPay Gateway can not be empty!');
        }

        if (!\filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)) {
            throw new InvalidValueException('The URL to the IxoPay Gateway should be a valid URL!');
        }

        static::$gatewayUrl = $url;
    }

    /**
     * Retrieves the currently set API URL.
     *
     * @return string
     */
    public static function getApiUrl() {
        return static::$gatewayUrl;
    }

    /**
     * Retrieves the default API URL.
     *
     * @return string
     */
    public static function getDefaultUrl() {
        return static::DEFAULT_IXOPAY_URL;
    }

    /**
     * Resets the API URL to it's default value.
     *
     * Please note that setting the API URL affects all instances (including the existing ones) of this client.
     *
     * @return void
     * @throws InvalidValueException
     */
    public static function resetApiUrl() {
        static::setApiUrl(static::DEFAULT_IXOPAY_URL);
    }

    /* deprecated */

    /**
     * @deprecated not in use anymore
     * @param Debit $transactionData
     */
    public function completeDebit(Debit $transactionData) { }

    /**
     * @deprecated not in use anymore
     * @param Register $transactionData
     */
    public function completeRegister(Register $transactionData) { }

    /**
     * @deprecated not in use anymore
     * @param Preauthorize $transactionData
     */
    public function completePreauthorize(Preauthorize $transactionData) { }

    /**
     * @deprecated not in use anymore
     * @return boolean
     */
    public function isTestMode() {
        return $this->testMode;
    }

    /**
     * @deprecated not in use anymore
     * @param boolean $testMode
     *
     * @return $this
     */
    public function setTestMode($testMode) {
        $this->testMode = $testMode;
        return $this;
    }

    /**
     * @deprecated use sendJsonApiRequest
     * @param string $xml
     *
     * @return Response
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     * @throws RateLimitException
     */
    protected function sendXmlRequest($xml, $url) {

        $httpResponse = $this->signAndSendXml($xml, $this->apiKey, $this->sharedSecret, $url);

        if ($httpResponse->getErrorCode() || $httpResponse->getErrorMessage()) {
            throw new ClientException('Request failed: ' . $httpResponse->getErrorCode() . ' ' . $httpResponse->getErrorMessage());
        }
        if ($httpResponse->getStatusCode() == 504 || $httpResponse->getStatusCode() == 522) {
            throw new TimeoutException('Request timed-out');
        }
        if ($httpResponse->getStatusCode() == 429) {
            $rateLimitMessage = 'Rate Limit exceeded';

            if (is_array($httpResponse->getHeaders())) {

                /**
                 *
                 * Following Headers are available in the response of rate-limited api requests:
                 *      "X-RateLimit-Limit"
                 *      "X-RateLimit-Remaining"
                 *      "Retry-After"
                 *
                 */

                $rateLimit = !empty($httpResponse->getHeaders()['X-RateLimit-Limit']) ? $httpResponse->getHeaders()['X-RateLimit-Limit'] : null;
                $retryAfter = !empty($httpResponse->getHeaders()['Retry-After']) ? $httpResponse->getHeaders()['Retry-After'] : null;

                if ($rateLimit) {
                    $rateLimitMessage .= ' | Rate Limit: '.$rateLimit;
                }
                if ($rateLimit) {
                    $rateLimitMessage .= ' | Retry-After: '.$retryAfter.' seconds';
                }
            }

            throw new RateLimitException($rateLimitMessage);
        }

        return $httpResponse;
    }

    /**
     * @deprecated
     * @param string              $transactionMethod
     * @param AbstractTransaction $transaction
     *
     * @return string
     */
    public function buildXml($transactionMethod, AbstractTransaction $transaction) {
        $host = parse_url(self::$gatewayUrl, PHP_URL_HOST);

        $xmlGenerator = new XmlGenerator();
        $xmlGenerator->setNamespaceRoot('http://'.$host);

        $dom = $xmlGenerator->generateTransaction(lcfirst($transactionMethod), $transaction, $this->username,
            $this->password, $this->language);
        $xml = $dom->saveXML();

        return $xml;
    }

}