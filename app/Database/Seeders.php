<?php
namespace App\Database;

use App\Core\Database;

class Seeders
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function run(): void
    {
        $this->seedUsers();
        $this->seedSites();
        echo "Seeders executed.\n";
    }

    private function seedUsers(): void
    {
        $exists = $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        if ($exists == 0) {
            $this->db->insert('users', [
                'name' => 'Super Admin',
                'email' => 'admin@autopublisherx.com',
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    private function seedSites(): void
    {
        // default site
    }
}