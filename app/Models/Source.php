<?php
namespace App\Models;

use App\Core\Model;

class Source extends Model
{
    protected static string $table = 'content_sources';
    
    public ?int $id = null;
    public ?string $name = null;
    public ?string $type = null; // rss, web
    public ?string $url = null;
    public ?string $css_selector = null;
    public ?string $xpath = null;
    public int $trust_score = 50;
    public ?string $created_at = null;
}