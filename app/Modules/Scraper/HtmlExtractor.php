<?php
namespace App\Modules\Scraper;

class HtmlExtractor
{
    public function extract(string $url, ?string $cssSelector, ?string $xpath): string
    {
        $html = file_get_contents($url);
        if (!$html) return '';
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpathObj = new \DOMXPath($dom);
        if ($xpath) {
            $nodes = $xpathObj->query($xpath);
            if ($nodes->length > 0) {
                return $dom->saveHTML($nodes->item(0));
            }
        }
        if ($cssSelector) {
            // Use simple CSS selector support via external lib? We'll do basic
        }
        return strip_tags($html, '<p><a><img>');
    }
}