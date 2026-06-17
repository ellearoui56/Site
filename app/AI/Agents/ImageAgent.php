<?php
namespace App\AI\Agents;

use App\AI\AIClient;

class ImageAgent
{
    public function generate(string $topic): ?string
    {
        $client = new AIClient();
        return $client->generateImage("Professional blog header image about $topic");
    }
}