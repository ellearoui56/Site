<?php
namespace App\Middleware;

use App\Security\Auth;

class AuthMiddleware
{
    public function handle(): bool
    {
        if (!Auth::check()) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthenticated.']);
            return false;
        }
        return true;
    }
}