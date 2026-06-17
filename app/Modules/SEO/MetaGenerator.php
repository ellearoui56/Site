<?php
namespace App\Modules\SEO;

class MetaGenerator
{
    public static function generate(string $title, string $description, string $url, string $image = ''): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'og_title' => $title,
            'og_description' => $description,
            'og_image' => $image,
            'og_url' => $url,
            'twitter_card' => 'summary_large_image',
        ];
    }
}