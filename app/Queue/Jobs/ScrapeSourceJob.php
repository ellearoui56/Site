<?php
namespace App\Queue\Jobs;

use App\Modules\Scraper\ScraperService;

class ScrapeSourceJob
{
    public function handle(array $payload): void
    {
        $sourceId = $payload['source_id'];
        $service = new ScraperService();
        $service->scrapeSource($sourceId);
    }
}