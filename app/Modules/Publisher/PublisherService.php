<?php
namespace App\Modules\Publisher;

use App\Core\Database;

class PublisherService
{
    public function publish(int $articleId, string $platform): void
    {
        $db = Database::getInstance();
        $article = $db->query("SELECT * FROM articles WHERE id = ?", [$articleId])->fetch();
        if (!$article) return;

        if ($platform === 'wordpress') {
            $adapter = new PlatformAdapters\WordpressAdapter();
            $adapter->post($article);
        } elseif ($platform === 'blogger') {
            $adapter = new PlatformAdapters\BloggerAdapter();
            $adapter->post($article);
        }

        $db->update('articles', ['status' => 'published', 'published_at' => date('Y-m-d H:i:s')], ['id' => $articleId]);
    }
}