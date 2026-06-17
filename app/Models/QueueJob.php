<?php
namespace App\Models;

use App\Core\Model;

class QueueJob extends Model
{
    protected static string $table = 'queue_jobs';
    
    public ?int $id = null;
    public ?string $job_class = null;
    public ?string $payload = null;
    public ?string $available_at = null;
    public ?string $reserved_at = null;
    public ?string $failed_at = null;
    public ?string $error = null;
    public ?string $created_at = null;

    public function getPayload(): array
    {
        return json_decode($this->payload, true) ?? [];
    }
}