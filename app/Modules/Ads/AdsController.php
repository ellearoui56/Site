<?php
namespace App\Modules\Ads;

use App\Core\Controller;

class AdsController extends Controller
{
    public function settings(): void
    {
        $this->view('ads/settings');
    }

    public function save(): void
    {
        $data = $this->request();
        $service = new AdsService();
        $service->updateSettings($data);
        $this->json(['success' => true]);
    }
}