<?php
namespace App\AI\Agents;

use App\AI\AIClient;

class AnalyticsAgent
{
    public function suggestImprovements(array $analyticsData): string
    {
        $client = new AIClient();
        $json = json_encode($analyticsData);
        return $client->chatCompletion([
            ['role' => 'user', 'content' => "Analyze these website analytics and suggest content improvements: $json"]
        ]);
    }
}