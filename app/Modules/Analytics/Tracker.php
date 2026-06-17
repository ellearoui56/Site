<?php
namespace App\Modules\Analytics;

use App\Core\Database;

class Tracker
{
    public function track(): void
    {
        $db = Database::getInstance();
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $url = $_SERVER['REQUEST_URI'] ?? '';
        $db->insert('analytics_visits', [
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'url' => $url,
            'visited_at' => date('Y-m-d H:i:s'),
        ]);
    }
}