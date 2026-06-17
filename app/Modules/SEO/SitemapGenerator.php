<?php
namespace App\Modules\SEO;

use App\Core\Database;

class SitemapGenerator
{
    public function generate(): void
    {
        $db = Database::getInstance();
        $articles = $db->query("SELECT slug, updated_at FROM articles WHERE site_id = ? AND status='published'", [\App\Core\Config::get('app.current_site_id')])->fetchAll();
        $xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($articles as $art) {
            $xml .= '<url><loc>https://' . $_SERVER['HTTP_HOST'] . '/article/' . $art['slug'] . '</loc><lastmod>' . date('c', strtotime($art['updated_at'])) . '</lastmod></url>';
        }
        $xml .= '</urlset>';
        file_put_contents(BASE_PATH . '/public/sitemap.xml', $xml);
    }
}