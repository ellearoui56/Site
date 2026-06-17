<?php
namespace App\Queue\Jobs;

use App\AI\ContentAI;
use App\Core\Logger;

class GenerateArticleJob
{
    public function handle(array $payload): void
    {
        $articleId = $payload['article_id'];
        Logger::info("Generating article ID $articleId...");
        $ai = new ContentAI();
        // Actual logic would fetch topic, generate content, save
        // Simplified
    }
}