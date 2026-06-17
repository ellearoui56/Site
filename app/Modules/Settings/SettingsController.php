<?php
namespace App\Modules\Settings;

use App\Core\Controller;

class SettingsController extends Controller
{
    public function index(): void
    {
        $this->view('settings/index');
    }

    public function update(): void
    {
        $service = new SettingsService();
        $service->update($this->request());
        $this->redirect('/settings');
    }
}