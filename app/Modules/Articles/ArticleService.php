<?php
namespace App\Modules\Articles;

use App\Core\Database;
use App\Core\Helpers;

class ArticleService
{
    public function getAllBySite(?int $siteId): array
    {
        return Article::where(['site_id' => $siteId]);
    }

    public function create(array $data, ?int $siteId): int
    {
        $db = Database::getInstance();
        $slug = Helpers::slugify($data['title']);
        return (int) $db->insert('articles', [
            'site_id' => $siteId,
            'title' => $data['title'],
            'slug' => $slug,
            'content' => $data['content'],
            'status' => 'draft',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function update(int $id, array $data): void
    {
        $db = Database::getInstance();
        $db->update('articles', [
            'title' => $data['title'],
            'content' => $data['content'],
            'updated_at' => date('Y-m-d H:i:s'),
        ], ['id' => $id]);
    }

    public function delete(int $id): void
    {
        $db = Database::getInstance();
        $db->delete('articles', ['id' => $id]);
    }

    public function createFromTopic(string $topic, ?int $siteId): int
    {
        return $this->create(['title' => $topic, 'content' => ''], $siteId);
    }
}