<?php
require __DIR__ . '/../public/index.php';
$service = new \App\Modules\Scraper\ScraperService();
$sources = $service->getAllSources();
foreach ($sources as $source) {
    $service->scrapeSource($source['id']);
}