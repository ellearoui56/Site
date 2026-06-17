<?php
namespace App\Modules\SEO;

use App\Core\Database;

class InternalLinking
{
    public function buildLinks(int $siteId): void
    {
        $db = Database::getInstance();
        $articles = $db->query("SELECT id, title, content FROM articles WHERE site_id = ? AND status='published'", [$siteId])->fetchAll();
        foreach ($articles as $source) {
            foreach ($articles as $target) {
                if ($source['id'] === $target['id']) continue;
                $keyword = strtolower($target['title']);
                if (stripos($source['content'], $keyword) !== false) {
                    // Insert link into content: wrap first occurrence with anchor
                    $link = "<a href=\"/article/{$target['id']}\">$keyword</a>";
                    $newContent = preg_replace('/' . preg_quote($keyword, '/') . '/i', $link, $source['content'], 1);
                    if ($newContent !== $source['content']) {
                        $db->update('articles', ['content' => $newContent], ['id' => $source['id']]);
                    }
                }
            }
        }
    }
}