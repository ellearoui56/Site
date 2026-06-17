<?php
namespace App\Modules\Auth;

use App\Core\Controller;
use App\Security\Auth;
use App\Security\Csrf;

class AuthController extends Controller
{
    public function loginForm(): void
    {
        $this->view('auth/login', ['csrf' => Csrf::field()]);
    }

    public function login(): void
    {
        $data = $this->request();
        if (!Csrf::validate($data['_token'] ?? '')) {
            $this->json(['error' => 'Invalid CSRF token'], 419);
        }
        if (Auth::attempt($data['email'], $data['password'])) {
            $this->redirect('/dashboard');
        } else {
            $this->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/login');
    }

    public function register(): void
    {
        // implement registration with site creation
    }
}