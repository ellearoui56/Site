<?php
namespace App\Queue;

use App\Core\Database;

class QueueManager
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function push(string $jobClass, array $payload, ?int $delaySeconds = null): int
    {
        $availableAt = $delaySeconds ? time() + $delaySeconds : time();
        $this->db->insert('queue_jobs', [
            'job_class' => $jobClass,
            'payload' => json_encode($payload),
            'available_at' => date('Y-m-d H:i:s', $availableAt),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function nextJob(): ?array
    {
        $now = date('Y-m-d H:i:s');
        $job = $this->db->query(
            "SELECT * FROM queue_jobs WHERE available_at <= ? AND reserved_at IS NULL ORDER BY available_at LIMIT 1",
            [$now]
        )->fetch();
        return $job ?: null;
    }

    public function reserve(int $jobId): void
    {
        $this->db->query("UPDATE queue_jobs SET reserved_at = ? WHERE id = ?", [date('Y-m-d H:i:s'), $jobId]);
    }

    public function complete(int $jobId): void
    {
        $this->db->query("DELETE FROM queue_jobs WHERE id = ?", [$jobId]);
    }

    public function fail(int $jobId, string $error): void
    {
        $this->db->query("UPDATE queue_jobs SET failed_at = ?, error = ? WHERE id = ?", [date('Y-m-d H:i:s'), $error, $jobId]);
    }
}