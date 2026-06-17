<?php
namespace App\Modules\API;

use App\Core\Controller;
use App\Security\Auth;
use App\Core\Config;

class ApiAuthController extends Controller
{
    public function token(): void
    {
        // API token authentication (simple for internal use)
        $apiKey = Config::get('app.api_key');
        $provided = $_SERVER['HTTP_X_API_KEY'] ?? '';
        if ($apiKey && hash_equals($apiKey, $provided)) {
            $this->json(['token' => bin2hex(random_bytes(32))]);
        } else {
            $this->json(['error' => 'Unauthorized'], 401);
        }
    }
}