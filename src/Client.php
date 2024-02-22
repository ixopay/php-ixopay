<?php

namespace Ixopay\Client;

use Ixopay\Client\CustomerProfile\CustomerData;
use Ixopay\Client\CustomerProfile\DeleteProfileResponse;
use Ixopay\Client\CustomerProfile\GetProfileResponse;
use Ixopay\Client\CustomerProfile\PaymentInstrument;
use Ixopay\Client\CustomerProfile\UpdateProfileResponse;
use Ixopay\Client\Dispute\DisputeAcceptData;
use Ixopay\Client\Dispute\DisputeMetadataData;
use Ixopay\Client\Dispute\DisputeSubmitEvidenceData;
use Ixopay\Client\Dispute\DisputeUploadEvidenceData;
use Ixopay\Client\Exception\GeneralErrorException;
use Ixopay\Client\Exception\TypeException;
use Ixopay\Client\Json\ErrorResponse;
use Ixopay\Client\Exception\RateLimitException;
use Ixopay\Client\Json\JsonParser;
use Ixopay\Client\Options\OptionsResult;
use Ixopay\Client\Schedule\ContinueSchedule;
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
use Ixopay\Client\Transaction\IncrementalAuthorization;
use Ixopay\Client\Transaction\Payout;
use Ixopay\Client\Transaction\Preauthorize;
use Ixopay\Client\Transaction\Refund;
use Ixopay\Client\Transaction\Register;
use Ixopay\Client\Transaction\Result;
use Ixopay\Client\Transaction\VoidTransaction;
use Ixopay\Client\Json\JsonGenerator;
use Ixopay\Client\Xml\Parser;
use Ixopay\Client\Xml\XmlGenerator;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class Client
 *
 * @package Ixopay\Client
 */
class Client
{
    const VERSION = '3.9.0';

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

    const SCHEDULE_ACTION_UPDATE = 'updateSchedule';

    const SCHEDULE_ACTION_SHOW = 'getSchedule';

    const SCHEDULE_ACTION_PAUSE = 'pauseSchedule';

    const SCHEDULE_ACTION_CONTINUE = 'continueSchedule';

    const SCHEDULE_ACTION_CANCEL = 'cancelSchedule';

    /* json endpoints */

    const CUSTOMER_PROFILE_GET = 'api/v3/customerProfiles/[API_KEY]/getProfile';
    const CUSTOMER_PROFILE_UPDATE = 'api/v3/customerProfiles/[API_KEY]/updateProfile';
    const CUSTOMER_PROFILE_DELETE = 'api/v3/customerProfiles/[API_KEY]/deleteProfile';

    const TRANSACTION_DEBIT = 'api/v3/transaction/[API_KEY]/debit';
    const TRANSACTION_PREAUTHORIZE = 'api/v3/transaction/[API_KEY]/preauthorize';
    const TRANSACTION_INCREMENTAL_AUTHORIZATION = 'api/v3/transaction/[API_KEY]/incrementalAuthorization';
    const TRANSACTION_CAPTURE = 'api/v3/transaction/[API_KEY]/capture';
    const TRANSACTION_VOID = 'api/v3/transaction/[API_KEY]/void';
    const TRANSACTION_REGISTER = 'api/v3/transaction/[API_KEY]/register';
    const TRANSACTION_DEREGISTER = 'api/v3/transaction/[API_KEY]/deregister';
    const TRANSACTION_REFUND = 'api/v3/transaction/[API_KEY]/refund';
    const TRANSACTION_PAYOUT = 'api/v3/transaction/[API_KEY]/payout';

    const STATUS_BY_UUID = 'api/v3/status/[API_KEY]/getByUuid/{uuid}';
    const STATUS_BY_MERCHANT_TRANSACTION_ID = 'api/v3/status/[API_KEY]/getByMerchantTransactionId/{merchantTransactionId}';

    const SCHEDULE_START = 'api/v3/schedule/[API_KEY]/start';
    const SCHEDULE_UPDATE = 'api/v3/schedule/[API_KEY]/{scheduleId}/update';
    const SCHEDULE_GET = 'api/v3/schedule/[API_KEY]/{scheduleId}/get';
    const SCHEDULE_PAUSE = 'api/v3/schedule/[API_KEY]/{scheduleId}/pause';
    const SCHEDULE_CONTINUE = 'api/v3/schedule/[API_KEY]/{scheduleId}/continue';
    const SCHEDULE_CANCEL = 'api/v3/schedule/[API_KEY]/{scheduleId}/cancel';

    const OPTIONS_REQUEST = 'api/v3/options/[API_KEY]/{optionsName}';

    const DISPUTE_ACCEPT = 'api/v3/dispute/[API_KEY]/accept/{uuid}';
    const DISPUTE_METADATA = 'api/v3/dispute/[API_KEY]/metadata/{uuid}';
    const DISPUTE_UPLOAD_EVIDENCE = 'api/v3/dispute/[API_KEY]/upload-evidence/{uuid}';
    const DISPUTE_SUBMIT_EVIDENCE = 'api/v3/dispute/[API_KEY]/submit-evidence/{uuid}';

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
     * @var array
     */
    protected $customRequestHeaders = [];

    /**
     * @var array
     */
    protected $customCurlOptions = [];

    /**
     * @var JsonGenerator
     */
    protected $generator;

    /**
     * @var bool
     */
    protected $newAlgo = false;

    /**
     * @param string $username
     * @param string $password
     * @param string $apiKey
     * @param string $sharedSecret
     * @param string $language
     * @param bool   $testMode - DEPRECATED
     * @param bool   $newAlgo
     */
    public function __construct($username, $password, $apiKey, $sharedSecret, $language = null, $testMode = false, $newAlgo = false) {
        $this->username = $username;
        $this->setPassword($password);
        $this->apiKey = $apiKey;
        $this->sharedSecret = $sharedSecret;
        $this->language = $language;
        $this->testMode = $testMode;
        $this->newAlgo = $newAlgo;
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
     * Set custom request headers for the CurlClient
     * @param array $headers
     * @return Client
     */
    public function setCustomRequestHeaders(array $headers = array()) {
        $this->customRequestHeaders = $headers;
        return $this;
    }

    /**
     * Set custom curl options for the CurlClient
     * @param array $curlOptions
     * @return Client
     */
    public function setCustomCurlOptions(array $curlOptions = array()) {
        $this->customCurlOptions = $curlOptions;
        return $this;
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
            case 'incrementalAuthorization':
                $endpoint .= self::TRANSACTION_INCREMENTAL_AUTHORIZATION;
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
     */
    public function pauseSchedule($scheduleData) {
        return $this->sendScheduleRequest(self::SCHEDULE_ACTION_PAUSE, $scheduleData);
    }

    /**
     * either pass ScheduleData object OR ContinueSchedule
     *
     * @param ScheduleData|ContinueSchedule $scheduleData
     *
     * @return Schedule\ScheduleResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     * @throws RateLimitException
     * @throws GeneralErrorException
     */
    public function continueSchedule($scheduleData) {
        return $this->sendScheduleRequest(self::SCHEDULE_ACTION_CONTINUE, $scheduleData);
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
     * @throws RateLimitException
     * @throws GeneralErrorException
     */
    public function cancelSchedule($scheduleData) {
        return $this->sendScheduleRequest(self::SCHEDULE_ACTION_CANCEL, $scheduleData);
    }

    /**
     * backwards compatible via ScheduleResultData
     * => in future only the new params should be supported:
     *  - StartSchedule (obj): used to start a schedule
     *  - ContinueSchedule (obj): used to continue schedule
     *  - string [scheduleId]: used to show, pause or cancel a schedule
     *
     * @param string                                             $action
     * @param ScheduleData|StartSchedule|ContinueSchedule|string $scheduleData
     *
     * @return Schedule\ScheduleResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     * @throws RateLimitException
     * @throws GeneralErrorException
     */
    public function sendScheduleRequest($action, $scheduleData) {
        $json = $this->getGenerator()->generateSchedule($action, $scheduleData);

        switch($action){
            case self::SCHEDULE_ACTION_START:
                $endpoint = self::SCHEDULE_START;
                break;
            case self::SCHEDULE_ACTION_UPDATE:
                $endpoint = self::SCHEDULE_UPDATE;
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
            if ($scheduleData instanceof ScheduleData || $scheduleData instanceof ContinueSchedule) {
                $endpoint = str_replace('{scheduleId}', $scheduleData->getScheduleId(), $endpoint);
            } elseif (is_string($scheduleData)) {
                $endpoint = str_replace('{scheduleId}', $scheduleData, $endpoint);
            }

        }

        if($action === self::SCHEDULE_ACTION_SHOW) {
            // GET request only
            $httpResponse = $this->sendJsonApiRequest($endpoint, [], true);
        } else{
            $httpResponse = $this->sendJsonApiRequest($endpoint, $json);
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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

        $httpResponse = $this->sendJsonApiRequest($endpoint, [], true);

        return $this->getParser()->parseStatusResult($httpResponse->getBody());
    }

    /**
     * @param string $path
     * @param array  $dataArray
     * @param bool   $get
     *
     * @return Response
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     * @throws RateLimitException
     * @throws GeneralErrorException
     */
    protected function sendJsonApiRequest($path, $dataArray=[], $get=false) {

        $url = self::$gatewayUrl . $path;

        $body = $get ? '' : json_encode($dataArray);

        $httpResponse = $this->signAndSendJson($body, $url, $this->username, $this->password, $this->apiKey, $this->sharedSecret, $get);

        $this->validateStatusCode($httpResponse);

        return $httpResponse;
    }

    /**
     * @param $path
     * @param $data
     * @return Response
     * @throws ClientException
     * @throws GeneralErrorException
     * @throws Http\Exception\ClientException
     * @throws RateLimitException
     * @throws TimeoutException
     */
    protected function sendMultiPartFormDataRequest($path, $data = [])
    {
        $url = self::$gatewayUrl . $path;

        $url = str_replace('[API_KEY]', $this->apiKey, $url);

        $httpResponse = $this->signAndSendMultiPartFormData(
            $data,
            $url,
            $this->username,
            $this->password,
            $this->apiKey,
            $this->sharedSecret
        );

        $this->validateStatusCode($httpResponse);

        return $httpResponse;
    }

    /**
     * @param Response $httpResponse
     * @return void
     * @throws ClientException
     * @throws GeneralErrorException
     * @throws RateLimitException
     * @throws TimeoutException
     */
    private function validateStatusCode(Response $httpResponse)
    {
        switch($statusCode = $httpResponse->getStatusCode()){
            case 504:
            case 522:
                throw new TimeoutException('Request timed-out');
            case 429:
                $rateLimitMsg = 'Too many requests';

                if (is_array($httpResponse->getHeaders())) {

                    $headers = array_change_key_case($httpResponse->getHeaders(), CASE_LOWER);
                    $rateLimitMsg .= !empty($headers['x-ratelimit-limit']) ? ' | Rate Limit: '.$headers['x-ratelimit-limit'] : '';
                    $rateLimitMsg .= !empty($headers['retry-after']) ? ' | Retry-After: '.$headers['retry-after'].' seconds' : '';

                }
                throw new RateLimitException($rateLimitMsg);
            default:
                if ($httpResponse->getErrorCode() || $httpResponse->getErrorMessage()) {
                    throw new ClientException('Request failed: ' . $httpResponse->getErrorCode() . ' ' . $httpResponse->getErrorMessage());
                }
                if ($statusCode >= 400) {
                    $json = json_decode($httpResponse->getBody(), true);
                    if (isset($json['errorMessage'])) {
                        $message = $json['errorMessage'];
                    } elseif (isset($json['message'])) {
                        $message = $json['message'];
                    } else{
                        $message = 'Request failed';
                    }
                    $code = isset($json['errorCode']) ? $json['errorCode'] : 0;
                    throw new GeneralErrorException($message, $code);
                }
                break;
        }
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
            ->setCustomHeaders($this->customRequestHeaders)
            ->setCustomCurlOptions($this->customCurlOptions)
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
     * @param $body
     * @param $url
     * @param $username
     * @param $password
     * @param $apiKey
     * @param $sharedSecret
     * @return Response
     * @throws Http\Exception\ClientException
     */
    protected function signAndSendMultiPartFormData($body, $url, $username, $password, $apiKey, $sharedSecret)
    {
        $this->log(LogLevel::DEBUG, "POST $url ",
            [
                'url' => $url,
                'body' => $body,
                'apiKey' => $apiKey,
                'sharedSecret' => $sharedSecret,
            ]
        );

        $curl = new CurlClient();
        $response = $curl
            ->setCustomHeaders($this->customRequestHeaders)
            ->setCustomCurlOptions($this->customCurlOptions)
            ->signMultiPart($sharedSecret, $url, $body, 'POST', false, true)
            ->setAuthentication($username, $password)
            ->post($url, $body, [], false);

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
     * @param         $jsonBody
     * @param string  $url
     *
     * @param string  $username
     * @param string  $password
     * @param string  $apiKey
     * @param string  $sharedSecret
     * @param boolean $get
     *
     * @return Response
     * @throws Http\Exception\ClientException
     */
    public function signAndSendJson($jsonBody, $url, $username, $password, $apiKey, $sharedSecret, $get) {
        $url = str_replace('[API_KEY]', $apiKey, $url);

        $type = $get ? 'GET' : 'POST';

        $this->log(LogLevel::DEBUG, "{$type} $url ",
            array(
                'url' => $url,
                'json' => $jsonBody,
                'apiKey' => $apiKey,
                'sharedSecret' => $sharedSecret,
            )
        );

        $curl = new CurlClient();
        $curl ->setCustomHeaders($this->customRequestHeaders)
            ->setCustomCurlOptions($this->customCurlOptions);
        $curl->signJson($sharedSecret, $url, $jsonBody, $type, false, $this->newAlgo)
             ->setAuthentication($username, $password);

        if($get){
            $response = $curl->get($url);
        } else{
            $response = $curl->post($url, $jsonBody);
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
     */
    public function preauthorize(Preauthorize $transactionData) {
        return $this->sendTransaction('preauthorize', $transactionData);
    }

    /**
     * increases or prolongs a preauthorization
     *
     * NOTE: not all payment methods support this function
     *
     * @param IncrementalAuthorization $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws RateLimitException
     * @throws GeneralErrorException
     */
    public function incrementalAuthorization(IncrementalAuthorization $transactionData) {
        return $this->sendTransaction('incrementalAuthorization', $transactionData);
    }

    /**
     * void a previously preauthorized transaction
     *
     * @param VoidTransaction $transactionData
     *
     * @return Result
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @param        $_          [deprecated]
     *
     * @return OptionsResult
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws RateLimitException
     * @throws GeneralErrorException
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
        if (strpos($requestBody, '<callback') !== false) {
            $parser = new Parser();
            return $parser->parseCallback($requestBody);
        } elseif (!($json = json_decode($requestBody, true))) {
            $parser = new Parser();
            return $parser->parseCallback($requestBody);
        } else {
            $jsonParser = new JsonParser();
            return $jsonParser->parseCallback($requestBody);
        }
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
            $dateHeader, $requestQuery, false, false);
        $digestNew = $curl->createSignature($this->getSharedSecret(), 'POST', $requestBody, 'text/xml; charset=utf-8',
            $dateHeader, $requestQuery, false, true);

        $expectedSig = 'IxoPay ' . $this->getApiKey() . ':' . $digest;
        $expectedSig2 = 'Gateway '.$this->getApiKey() . ':' . $digest;
        $expectedSig3 = 'Gateway '.$this->getApiKey() . ':' . $digestNew;


        $expectedSigJson = $curl->createSignature($this->getSharedSecret(), 'POST', $requestBody, 'application/json; charset=utf-8',
            $dateHeader, $requestQuery, true, false);
        $expectedSigJsonNew = $curl->createSignature($this->getSharedSecret(), 'POST', $requestBody, 'application/json; charset=utf-8',
            $dateHeader, $requestQuery, true, true);

        if ($authorizationHeader == $expectedSigJson || $authorizationHeader == $expectedSigJsonNew) {
            return true;
        }

        if (strpos($authorizationHeader, 'Authorization:') !== false) {
            $authorizationHeader = trim(str_replace('Authorization:', '', $authorizationHeader));
        }

        if ($authorizationHeader === $expectedSig || $authorizationHeader === $expectedSig2 || $authorizationHeader == $expectedSig3) {
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

        //new JSON validation
        $signature = null;
        if (!empty($_SERVER['HTTP_X_SIGNATURE'])) {
            $signature = $_SERVER['HTTP_X_SIGNATURE'];
        } elseif (!empty($_SERVER['X_SIGNATURE'])) {
            $signature = $_SERVER['X_SIGNATURE'];
        }
        if ($signature) {
            return $this->validateCallback($requestBody, $requestQuery, $dateHeader, $signature);
        }

        //old XML validation
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
     *
     * @return GetProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     *
     * @return GetProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     *
     * @return DeleteProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     *
     * @return DeleteProfileResponse|ErrorResponse
     * @throws ClientException
     * @throws Http\Exception\ClientException
     * @throws TimeoutException#
     * @throws RateLimitException
     * @throws GeneralErrorException
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
     * @param DisputeAcceptData $disputeAcceptData
     * @return Dispute\DisputeResult
     * @throws ClientException
     * @throws GeneralErrorException
     * @throws Http\Exception\ClientException
     * @throws RateLimitException
     * @throws TimeoutException
     */
    public function acceptDispute(DisputeAcceptData $disputeAcceptData)
    {
        $url = $this->parseDisputeUrl(
            $disputeAcceptData->getUuid(),
            self::DISPUTE_ACCEPT
        );

        $data = [];

        if ($extraData = $disputeAcceptData->getExtraData()) {
            $data['extraData'] = $this->getGenerator()->stringifyExtraData($extraData);
        }

        $httpResponse = $this->sendJsonApiRequest($url, $data);

        return $this->getParser()->parseDisputeResult($httpResponse->getBody());
    }

    /**
     * @param DisputeMetadataData $disputeMetadataData
     * @return Dispute\DisputeResult
     * @throws ClientException
     * @throws GeneralErrorException
     * @throws Http\Exception\ClientException
     * @throws RateLimitException
     * @throws TimeoutException
     */
    public function fetchDisputeMetadata(DisputeMetadataData $disputeMetadataData)
    {
        $url = $this->parseDisputeUrl(
            $disputeMetadataData->getUuid(),
            self::DISPUTE_METADATA
        );

        $data = [];

        if ($extraData = $disputeMetadataData->getExtraData()) {
            $data['extraData'] = $this->getGenerator()->stringifyExtraData($extraData);
        }

        $httpResponse = $this->sendJsonApiRequest($url, $data);

        return $this->getParser()->parseDisputeResult($httpResponse->getBody());
    }

    /**
     * @param DisputeUploadEvidenceData $disputeUploadEvidenceData
     * @return Dispute\DisputeResult
     * @throws ClientException
     * @throws GeneralErrorException
     * @throws Http\Exception\ClientException
     * @throws RateLimitException
     * @throws TimeoutException
     */
    public function uploadDisputeEvidence(DisputeUploadEvidenceData $disputeUploadEvidenceData)
    {
        $url = $this->parseDisputeUrl(
            $disputeUploadEvidenceData->getUuid(),
            self::DISPUTE_UPLOAD_EVIDENCE
        );

        $data = [];

        if ($extraData = $disputeUploadEvidenceData->getExtraData()) {
            $data['extraData'] = json_encode(
                $this->getGenerator()->stringifyExtraData($extraData)
            );
        }

        $curlFile = new \CURLFile(
            $disputeUploadEvidenceData->getFilePathWithFileName(),
            null,
            $disputeUploadEvidenceData->getPostName()
        );

        $data['file'] = $curlFile;

        $httpResponse = $this->sendMultiPartFormDataRequest($url, $data);

        return $this->getParser()->parseDisputeResult($httpResponse->getBody());
    }

    /**
     * @param DisputeSubmitEvidenceData $disputeSubmitEvidenceData
     * @return Dispute\DisputeResult
     * @throws ClientException
     * @throws GeneralErrorException
     * @throws Http\Exception\ClientException
     * @throws RateLimitException
     * @throws TimeoutException
     */
    public function submitDisputeEvidence(DisputeSubmitEvidenceData $disputeSubmitEvidenceData)
    {
        $url = $this->parseDisputeUrl(
            $disputeSubmitEvidenceData->getUuid(),
            self::DISPUTE_SUBMIT_EVIDENCE
        );

        $data = [];

        if ($extraData = $disputeSubmitEvidenceData->getExtraData()) {
            $data['extraData'] = $this->getGenerator()->stringifyExtraData($extraData);
        }

        $httpResponse = $this->sendJsonApiRequest($url, $data);

        return $this->getParser()->parseDisputeResult($httpResponse->getBody());
    }

    /**
     * @param $uuid
     * @return string
     */
    private function parseDisputeUrl($uuid, $subject)
    {
        return str_replace(
            '{uuid}',
            $uuid,
            $subject
        );
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

        if (PHP_MAJOR_VERSION < 7 || (PHP_MAJOR_VERSION === 7 && PHP_MINOR_VERSION < 3)) {
            if (!\filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)) {
                throw new InvalidValueException('The URL to the IxoPay Gateway should be a valid URL!');
            }
        } else {
            if (!\filter_var($url, FILTER_VALIDATE_URL)) {
                throw new InvalidValueException('The URL to the IxoPay Gateway should be a valid URL!');
            }
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
     * @param string $url
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
