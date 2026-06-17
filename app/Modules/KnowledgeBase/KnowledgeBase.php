<?php
namespace App\Modules\KnowledgeBase;

use App\Core\Database;

class KnowledgeBase
{
    public function storeFact(string $key, string $value): void
    {
        $db = Database::getInstance();
        $db->query("INSERT OR REPLACE INTO knowledge_base (keyword, content) VALUES (?, ?)", [$key, $value]);
    }

    public function avoidDuplication(string $text): bool
    {
        $db = Database::getInstance();
        $similar = $db->query("SELECT COUNT(*) FROM articles WHERE content LIKE ?", ['%' . substr($text, 0, 100) . '%'])->fetchColumn();
        return $similar > 0;
    }
}