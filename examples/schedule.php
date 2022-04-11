<?php

// include the autoloader
require_once('path/to/vendor/autoload.php');

use Ixopay\Client\Client;
use Ixopay\Client\Schedule\StartSchedule;

// instantiate the "Ixopay\Client\Client" with your credentials
$client = new Client("username", "password", "apiKey", "sharedSecret");

// starting a schedule on an initial register transaction
// to start a schedule make use of StartSchedule
$startSchedule = new StartSchedule();
$startSchedule->setRegistrationUuid('uuid_of_initial_register_here')
    ->setAmount("9.99")
    ->setCurrency('EUR')
    ->setPeriodLength(4)
    ->setPeriodUnit(StartSchedule::PERIOD_UNIT_MONTH)
    ->setStartDateTime(new \DateTime());

// send request
$result = $client->startSchedule($startSchedule);

// handle result here
if($result->isSuccess()){
    // $result->getScheduleId();
} else{
    // $result->getErrorMessage();
    // $result->getErrorCode();
}

/*
// other schedule handling examples
$scheduleId = 'schedule_id_comes_here';

$result = $client->showSchedule($scheduleId);
$result = $client->pauseSchedule($scheduleId);
$result = $client->continueSchedule($scheduleId, new \DateTime('2020-10-10 10:00:00 UTC'));
$result = $client->cancelSchedule($scheduleId);

// handle result accordingly
*/