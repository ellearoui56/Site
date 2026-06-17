<?php
namespace App\Queue;

class JobDispatcher
{
    private QueueManager $queue;

    public function __construct()
    {
        $this->queue = new QueueManager();
    }

    public function dispatch(string $jobClass, array $payload, ?int $delay = null): int
    {
        return $this->queue->push($jobClass, $payload, $delay);
    }
}