<?php
namespace App\Modules\Publisher;

use App\Core\Controller;

class PublisherController extends Controller
{
    public function publish(int $articleId): void
    {
        $service = new PublisherService();
        $platform = $this->request()['platform'] ?? 'wordpress';
        $service->publish($articleId, $platform);
        $this->json(['message' => 'Published']);
    }
}