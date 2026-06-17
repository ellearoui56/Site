<?php
namespace App\Modules\Scraper;

class RssParser
{
    public function parse(string $url): array
    {
        $xml = simplexml_load_file($url);
        if (!$xml) return [];
        $items = [];
        foreach ($xml->channel->item as $item) {
            $items[] = [
                'title' => (string)$item->title,
                'link' => (string)$item->link,
                'content' => (string)($item->description ?? $item->children('content', true)->encoded),
                'pub_date' => (string)$item->pubDate,
            ];
        }
        return $items;
    }
}