<?php
namespace App\Modules\SEO;

use App\Core\Controller;

class SeoController extends Controller
{
    public function settings(): void
    {
        $this->view('seo/settings');
    }

    public function generateSitemap(): void
    {
        $generator = new SitemapGenerator();
        $generator->generate();
        $this->json(['message' => 'Sitemap generated.']);
    }

    public function internalLinking(): void
    {
        $service = new SeoService();
        $service->buildInternalLinks();
        $this->json(['message' => 'Internal linking updated.']);
    }
}