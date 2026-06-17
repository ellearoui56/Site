<?php
require __DIR__ . '/../public/index.php';
$db = \App\Core\Database::getInstance();
$articles = $db->query("SELECT id FROM articles WHERE status='scheduled' AND scheduled_at <= NOW()")->fetchAll();
$publisher = new \App\Modules\Publisher\PublisherService();
foreach ($articles as $art) {
    $publisher->publish($art['id'], 'wordpress');
}