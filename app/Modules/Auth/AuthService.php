<?php
namespace App\Modules\Auth;

use App\Core\Database;

class AuthService
{
    public function createUser(string $name, string $email, string $password, string $role = 'editor'): int
    {
        $db = Database::getInstance();
        return (int) $db->insert('users', [
            'name' => $name,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}