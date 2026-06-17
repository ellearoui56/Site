<?php
namespace App\Modules\Scraper;

use App\Core\Controller;

class ScraperController extends Controller
{
    public function sources(): void
    {
        $service = new ScraperService();
        $sources = $service->getAllSources();
        $this->view('scraper/sources', ['sources' => $sources]);
    }

    public function addSource(): void
    {
        $data = $this->request();
        $service = new ScraperService();
        $service->addSource($data);
        $this->redirect('/scraper/sources');
    }

    public function scrapeNow(int $id): void
    {
        $service = new ScraperService();
        $service->scrapeSource($id);
        $this->json(['message' => 'Scraping completed']);
    }
}