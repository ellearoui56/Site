<?php
namespace App\Modules\Dashboard;

use App\Core\Database;

class DashboardService
{
    public function getStats(?int $siteId): array
    {
        $db = Database::getInstance();
        return [
            'articles_published' => $db->query("SELECT COUNT(*) FROM articles WHERE site_id = ? AND status = 'published'", [$siteId])->fetchColumn(),
            'articles_scheduled' => $db->query("SELECT COUNT(*) FROM articles WHERE site_id = ? AND status = 'scheduled'", [$siteId])->fetchColumn(),
            'visitors_today' => $db->query("SELECT COUNT(*) FROM analytics_visits WHERE site_id = ? AND DATE(visited_at) = CURDATE()", [$siteId])->fetchColumn(),
            'ai_usage_today' => $db->query("SELECT COUNT(*) FROM ai_requests WHERE site_id = ? AND DATE(created_at) = CURDATE()", [$siteId])->fetchColumn(),
            'queue_jobs' => $db->query("SELECT COUNT(*) FROM queue_jobs")->fetchColumn(),
        ];
    }
}