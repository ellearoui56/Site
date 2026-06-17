<?php
namespace App\Modules\Dashboard;

use App\Core\Controller;
use App\Security\Auth;

class DashboardController extends Controller
{
    private DashboardService $service;

    public function __construct()
    {
        $this->service = new DashboardService();
    }

    public function index(): void
    {
        $stats = $this->service->getStats(Auth::siteId());
        $this->view('dashboard/index', ['stats' => $stats]);
    }

    public function apiStats(): void
    {
        $stats = $this->service->getStats(Auth::siteId());
        $this->json($stats);
    }
}