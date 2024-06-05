<?php

require 'init.php';

use App\Services\QueueClient;

$queueName = 'leads';
$queue = QueueClient::instance();

echo "Worker started".PHP_EOL;

use AndrewBreksa\RSMQ\ExecutorInterface;
use AndrewBreksa\RSMQ\Message;
use AndrewBreksa\RSMQ\QueueWorker;
use AndrewBreksa\RSMQ\WorkerSleepProvider;

$executor = new class() implements ExecutorInterface {
    public function __invoke(Message $message): bool
    {
        try {
            /** @var \LeadGenerator\Lead $lead */
            $lead = unserialize($message->getMessage());

            $leadHandler = new \App\Services\LeadHandler();
            $leadHandler->handle($lead);
        } catch (Throwable $exception) {
            echo $exception->getMessage().PHP_EOL;
        }

        //true will ack/delete the message, false will allow the queue's config to "re-publish"
        return true;
    }
};

$sleepProvider = new class() implements WorkerSleepProvider {
    public function getSleep(): ?int
    {
        /**
         * This allows you to return null to stop the worker, which can be used with something like redis to mark.
         *
         * Note that this method is called _before_ we pull for a message, and therefore if it returns null we'll eject
         * before we process a message.
         */
        return 0;
    }
};

$worker = new QueueWorker($queue, $executor, $sleepProvider, $queueName);
$worker->work(); // here we can optionally pass true to only process one message