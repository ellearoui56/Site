<?php
namespace App\Modules\Articles;

use App\AI\Agents\AgentOrchestrator;
use App\Core\Database;
use App\Queue\JobDispatcher;
use App\Queue\Jobs\GenerateArticleJob;

class ContentFactory
{
    public function generateFromTopic(string $topic, int $siteId, int $count = 10): void
    {
        // Generate cluster of subtopics using AI and create many articles
        $subtopics = $this->expandTopics($topic);
        foreach ($subtopics as $sub) {
            $articleId = (new ArticleService())->createFromTopic($sub, $siteId);
            (new JobDispatcher())->dispatch(GenerateArticleJob::class, ['article_id' => $articleId]);
        }
    }

    private function expandTopics(string $topic): array
    {
        $client = new \App\AI\AIClient();
        $response = $client->chatCompletion([
            ['role' => 'user', 'content' => "List 10 subtopics for the main topic: $topic"]
        ]);
        return array_filter(explode("\n", $response));
    }
}