<?php
namespace App\AI\Agents;

use App\AI\AIClient;

class HumanizerAgent
{
    public function rewrite(string $text): string
    {
        $client = new AIClient();
        return $client->chatCompletion([
            ['role' => 'user', 'content' => "Rewrite the following to sound more natural and human-like while keeping the facts:\n\n$text"]
        ]);
    }
}