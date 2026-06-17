<?php
namespace App\Core;

class Database
{
    private static ?self $instance = null;
    private \PDO $pdo;

    private function __construct()
    {
        $driver = Config::get('database.default', 'mysql');
        if ($driver === 'sqlite') {
            $path = Config::get('database.sqlite.path', BASE_PATH . '/database/sqlite.db');
            $this->pdo = new \PDO("sqlite:$path");
            $this->pdo->exec('PRAGMA journal_mode=WAL');
        } else {
            $host = Config::get('database.mysql.host', '127.0.0.1');
            $port = Config::get('database.mysql.port', '3306');
            $dbname = Config::get('database.mysql.database', 'autopublisher');
            $user = Config::get('database.mysql.username', 'root');
            $pass = Config::get('database.mysql.password', '');
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
            $this->pdo = new \PDO($dsn, $user, $pass, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    public function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function insert(string $table, array $data): string
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $this->query("INSERT INTO $table ($columns) VALUES ($placeholders)", array_values($data));
        return $this->pdo->lastInsertId();
    }

    public function update(string $table, array $data, array $where): int
    {
        $sets = implode(' = ?, ', array_keys($data)) . ' = ?';
        $whereClauses = implode(' AND ', array_map(fn($col) => "$col = ?", array_keys($where)));
        $params = array_values($data);
        $params = array_merge($params, array_values($where));
        $stmt = $this->query("UPDATE $table SET $sets WHERE $whereClauses", $params);
        return $stmt->rowCount();
    }

    public function delete(string $table, array $where): int
    {
        $whereClauses = implode(' AND ', array_map(fn($col) => "$col = ?", array_keys($where)));
        $stmt = $this->query("DELETE FROM $table WHERE $whereClauses", array_values($where));
        return $stmt->rowCount();
    }

    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}