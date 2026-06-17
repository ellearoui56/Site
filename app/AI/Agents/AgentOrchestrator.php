<?php
namespace App\AI\Agents;

use App\AI\ContentAI;

class AgentOrchestrator
{
    public function produceArticle(string $topic, array $options = []): array
    {
        // Run research agent
        $research = (new ResearchAgent())->execute($topic);
        // Fact check
        $facts = (new FactCheckerAgent())->check($research);
        // Write
        $draft = (new WriterAgent())->write($topic, $facts, $options['style'] ?? 'informative');
        // SEO optimize
        $seoData = (new SEOAgent())->optimize($draft);
        // Humanize
        $humanized = (new HumanizerAgent())->rewrite($draft);
        // Image generation
        $imageUrl = (new ImageAgent())->generate($topic);
        return [
            'title' => $seoData['title'],
            'content' => $humanized,
            'meta' => $seoData,
            'image' => $imageUrl,
            'research' => $research,
        ];
    }
}