<?php
namespace App\Modules\SEO;

use App\Modules\Articles\ContentFactory;

class TopicCluster
{
    public function createPillarCluster(string $mainTopic, int $siteId): void
    {
        // Create pillar page
        $factory = new ContentFactory();
        $factory->generateFromTopic($mainTopic, $siteId, 1); // pillar
        // Create cluster articles
        $factory->generateFromTopic($mainTopic, $siteId, 5);
    }
}