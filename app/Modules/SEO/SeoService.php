<?php
namespace App\Modules\SEO;

use App\Core\Database;
use App\Core\Helpers;

class SeoService
{
    public function optimizeArticle(int $articleId): void
    {
        // Use AI to analyze and improve content SEO
        // Update meta fields in DB
    }

    public function buildInternalLinks(): void
    {
        // Find articles with common keywords and create links
        $db = Database::getInstance();
        $articles = $db->query("SELECT id, title, content FROM articles WHERE site_id = ?", [\App\Core\Config::get('app.current_site_id')])->fetchAll();
        foreach ($articles as $article) {
            foreach ($articles as $target) {
                if ($article['id'] === $target['id']) continue;
                $keyword = Helpers::slugify($target['title']);
                if (str_contains($article['content'], $keyword)) {
                    // insert link
                }
            }
        }
    }
}