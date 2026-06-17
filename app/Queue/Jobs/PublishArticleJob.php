<?php
namespace App\Queue\Jobs;

use App\Modules\Publisher\PublisherService;

class PublishArticleJob
{
    public function handle(array $payload): void
    {
        $articleId = $payload['article_id'];
        $platform = $payload['platform'] ?? 'wordpress';
        $service = new PublisherService();
        $service->publish($articleId, $platform);
    }
}