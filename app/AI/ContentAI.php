<?php
namespace App\AI;

class ContentAI
{
    private AIClient $client;

    public function __construct()
    {
        $this->client = new AIClient();
    }

    public function generateArticle(string $topic, array $options = []): array
    {
        // 1. Research
        $researchPrompt = PromptBuilder::buildResearchPrompt($topic);
        $research = $this->client->chatCompletion([['role' => 'user', 'content' => $researchPrompt]]);

        // 2. Write
        $writerPrompt = PromptBuilder::buildWriterPrompt($topic, $research, $options['style'] ?? 'informative');
        $content = $this->client->chatCompletion([['role' => 'user', 'content' => $writerPrompt]]);

        // 3. SEO meta
        $seoPrompt = PromptBuilder::buildSeoPrompt($content);
        $seoResponse = $this->client->chatCompletion([['role' => 'user', 'content' => $seoPrompt]]);
        $seo = ResponseParser::extractJson($seoResponse);

        // 4. Humanize (optional)
        if ($options['humanize'] ?? true) {
            $humanizePrompt = PromptBuilder::buildHumanizerPrompt($content);
            $content = $this->client->chatCompletion([['role' => 'user', 'content' => $humanizePrompt]]);
        }

        return [
            'title' => $seo['title'] ?? $topic,
            'meta_description' => $seo['description'] ?? '',
            'content' => $content,
            'research' => $research,
        ];
    }

    public function generateImage(string $topic): ?string
    {
        $prompt = "A professional, high-quality featured image about $topic, realistic style";
        return $this->client->generateImage($prompt);
    }
}