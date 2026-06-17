<?php
namespace App\AI\Agents;

use App\AI\AIClient;
use App\AI\ResponseParser;

class SEOAgent
{
    public function optimize(string $content): array
    {
        $client = new AIClient();
        $response = $client->chatCompletion([
            ['role' => 'user', 'content' => "Optimize SEO for this content and output JSON with title, meta_description, keywords. Content: $content"]
        ]);
        return ResponseParser::extractJson($response);
    }
}