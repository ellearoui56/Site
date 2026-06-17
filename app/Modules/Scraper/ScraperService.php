<?php
namespace App\Modules\Scraper;

use App\Core\Database;
use App\Core\Logger;

class ScraperService
{
    public function getAllSources(): array
    {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM content_sources")->fetchAll();
    }

    public function addSource(array $data): void
    {
        $db = Database::getInstance();
        $db->insert('content_sources', [
            'name' => $data['name'],
            'type' => $data['type'], // rss or web
            'url' => $data['url'],
            'css_selector' => $data['css_selector'] ?? null,
            'xpath' => $data['xpath'] ?? null,
            'trust_score' => $data['trust_score'] ?? 50,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function scrapeSource(int $sourceId): void
    {
        $db = Database::getInstance();
        $source = $db->query("SELECT * FROM content_sources WHERE id = ?", [$sourceId])->fetch();
        if (!$source) return;
        if ($source['type'] === 'rss') {
            $parser = new RssParser();
            $items = $parser->parse($source['url']);
            foreach ($items as $item) {
                // Save as draft article
                $db->insert('articles', [
                    'site_id' => \App\Core\Config::get('app.current_site_id'),
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'source_url' => $item['link'],
                    'status' => 'draft',
                ]);
            }
        } else {
            $extractor = new HtmlExtractor();
            $content = $extractor->extract($source['url'], $source['css_selector'], $source['xpath']);
            // save
        }
        Logger::info("Source $sourceId scraped");
    }
}