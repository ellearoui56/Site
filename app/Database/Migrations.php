<?php
namespace App\Database;

use App\Core\Database;

class Migrations
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function run(): void
    {
        $migrationFiles = glob(BASE_PATH . '/database/migrations/*.php');
        sort($migrationFiles);
        foreach ($migrationFiles as $file) {
            $migration = require $file;
            if (is_callable($migration)) {
                $migration($this->db);
                echo "Migrated: " . basename($file) . "\n";
            }
        }
    }

    public function rollback(): void
    {
        // Implement rollback logic if needed
    }
}