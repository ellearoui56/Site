<?php
namespace App\Models;

use App\Core\Model;

class Site extends Model
{
    protected static string $table = 'sites';
    
    public ?int $id = null;
    public ?string $domain = null;
    public ?string $name = null;
    public ?string $settings = null; // JSON
    public ?string $created_at = null;

    public function getSettings(): array
    {
        return json_decode($this->settings, true) ?? [];
    }

    public function setSettings(array $settings): void
    {
        $this->settings = json_encode($settings);
    }
}