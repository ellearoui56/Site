<?php
namespace App\Modules\API;

use App\Core\Controller;

class ApiController extends Controller
{
    public function status(): void
    {
        $this->json(['status' => 'online', 'version' => '1.0.0', 'timestamp' => date('c')]);
    }
}