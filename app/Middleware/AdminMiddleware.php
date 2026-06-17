<?php
namespace App\Middleware;

use App\Security\Auth;

class AdminMiddleware
{
    public function handle(): bool
    {
        if (!Auth::check() || Auth::role() !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden. Admin only.']);
            return false;
        }
        return true;
    }
}