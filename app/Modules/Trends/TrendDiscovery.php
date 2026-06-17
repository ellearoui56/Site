<?php
namespace App\Modules\Trends;

use App\AI\AIClient;
use App\Modules\Articles\ContentFactory;

class TrendDiscovery
{
    public function discoverAndGenerate(): void
    {
        $client = new AIClient();
        $trends = $client->chatCompletion([
            ['role' => 'user', 'content' => 'What are the top 5 trending topics in technology today?']
        ]);
        $topics = explode("\n", $trends);
        $factory = new ContentFactory();
        foreach ($topics as $topic) {
            $factory->generateFromTopic(trim($topic), 1, 5);
        }
    }
}