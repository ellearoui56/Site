<?php
namespace App\AI\Agents;

class PublisherAgent
{
    public function schedule(array $article, string $platform): void
    {
        // Dispatch publish job
        (new \App\Queue\JobDispatcher())->dispatch(
            \App\Queue\Jobs\PublishArticleJob::class,
            ['article_id' => $article['id'], 'platform' => $platform],
            strtotime($article['scheduled_at']) - time()
        );
    }
}