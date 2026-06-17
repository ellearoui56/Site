<?php
namespace App\Modules\Trends;

use App\AI\AIClient;

class ContentGapAnalyzer
{
    public function analyze(string $competitorUrl): array
    {
        $client = new AIClient();
        $response = $client->chatCompletion([
            ['role' => 'user', 'content' => "Analyze the content of $competitorUrl and list topics they cover that we might be missing."]
        ]);
        return array_filter(explode("\n", $response));
    }
}