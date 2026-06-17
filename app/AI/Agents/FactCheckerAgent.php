<?php
namespace App\AI\Agents;

use App\AI\AIClient;

class FactCheckerAgent
{
    public function check(string $research): string
    {
        $client = new AIClient();
        $response = $client->chatCompletion([
            ['role' => 'user', 'content' => "Verify and correct any factual errors in this research: $research"]
        ]);
        return $response;
    }
}