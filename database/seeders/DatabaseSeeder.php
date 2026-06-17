<?php
namespace Database\Seeders;

use App\Core\Database;

class DatabaseSeeder
{
    public function run(): void
    {
        // Call individual seeders
        $db = Database::getInstance();
        // Seed default data
        if ($db->query("SELECT COUNT(*) FROM users")->fetchColumn() == 0) {
            $db->insert('users', [
                'name' => 'Admin',
                'email' => 'admin@autopublisherx.com',
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                'role' => 'admin',
            ]);
        }
    }
}