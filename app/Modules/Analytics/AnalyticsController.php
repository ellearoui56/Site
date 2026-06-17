<?php
namespace App\Modules\Analytics;

use App\Core\Controller;

class AnalyticsController extends Controller
{
    public function dashboard(): void
    {
        $service = new AnalyticsService();
        $data = $service->getDashboardData();
        $this->view('analytics/dashboard', ['data' => $data]);
    }

    public function track(): void
    {
        $tracker = new Tracker();
        $tracker->track();
    }
}