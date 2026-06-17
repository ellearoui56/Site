<?php
namespace App\Modules\Images;

use App\AI\AIClient;

class ImageStudio
{
    public function generateFeaturedImage(string $topic): ?string
    {
        return (new AIClient())->generateImage($topic);
    }

    public function batchGenerate(array $topics): array
    {
        $images = [];
        foreach ($topics as $topic) {
            $images[$topic] = $this->generateFeaturedImage($topic);
        }
        return $images;
    }
}