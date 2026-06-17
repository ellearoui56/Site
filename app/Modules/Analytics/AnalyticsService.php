<?php
namespace App\Modules\Analytics;

use App\Core\Database;

class AnalyticsService
{
    public function getDashboardData(): array
    {
        $db = Database::getInstance();
        return [
            'visitors' => $db->query("SELECT COUNT(*) FROM analytics_visits")->fetchColumn(),
            'pageviews' => $db->query("SELECT COUNT(*) FROM analytics_pageviews")->fetchColumn(),
        ];
    }
}