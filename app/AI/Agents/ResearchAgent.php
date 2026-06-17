<?php
namespace App\AI\Agents;

use App\AI\AIClient;

class ResearchAgent
{
    public function execute(string $topic): string
    {
        $client = new AIClient();
        return $client->chatCompletion([
            ['role' => 'system', 'content' => 'You are a research agent. Provide detailed facts, statistics, and insights.'],
            ['role' => 'user', 'content' => "Research the topic: $topic"]
        ]);
    }
}