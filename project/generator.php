<?php

require 'init.php';

use App\Services\Config;
use App\Services\QueueClient;
use LeadGenerator\Lead;

$leadGeneratorConfig = Config::instance()->get('lead_generator');
$queueName = $leadGeneratorConfig['queue_name'] ?? null;

if (!$queueName) {
    throw new Exception('Queue name for lead-generator is not defined');
}

$queue = QueueClient::instance();
if (!in_array($queueName, $queue->listQueues())) {
    $queue->createQueue($queueName);
}

$generator = new \LeadGenerator\Generator();
$generator->generateLeads(10000, function (Lead $lead) use ($queue, $queueName) {
    $queue->sendMessage($queueName, serialize($lead));
});