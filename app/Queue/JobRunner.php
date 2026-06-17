<?php
namespace App\Queue;

class JobRunner
{
    private QueueManager $queue;

    public function __construct()
    {
        $this->queue = new QueueManager();
    }

    public function processNext(): bool
    {
        $job = $this->queue->nextJob();
        if (!$job) return false;
        $this->queue->reserve($job['id']);
        $class = $job['job_class'];
        if (!class_exists($class)) {
            $this->queue->fail($job['id'], "Job class $class not found.");
            return false;
        }
        try {
            $instance = new $class();
            $payload = json_decode($job['payload'], true);
            $instance->handle($payload);
            $this->queue->complete($job['id']);
            return true;
        } catch (\Throwable $e) {
            $this->queue->fail($job['id'], $e->getMessage());
            return false;
        }
    }
}