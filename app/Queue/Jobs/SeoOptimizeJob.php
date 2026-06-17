<?php
namespace App\Queue\Jobs;

use App\Modules\SEO\SeoService;

class SeoOptimizeJob
{
    public function handle(array $payload): void
    {
        $articleId = $payload['article_id'];
        $service = new SeoService();
        $service->optimizeArticle($articleId);
    }
}