<?php
namespace App\Core;

abstract class Model
{
    protected static string $table;
    protected static string $primaryKey = 'id';
    protected Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public static function find(int $id): ?static
    {
        $instance = new static();
        $row = $instance->db->query("SELECT * FROM " . static::$table . " WHERE " . static::$primaryKey . " = ?", [$id])->fetch();
        if ($row) {
            foreach ($row as $key => $value) {
                $instance->$key = $value;
            }
            return $instance;
        }
        return null;
    }

    public static function all(): array
    {
        $instance = new static();
        $rows = $instance->db->query("SELECT * FROM " . static::$table)->fetchAll();
        $models = [];
        foreach ($rows as $row) {
            $model = new static();
            foreach ($row as $key => $value) {
                $model->$key = $value;
            }
            $models[] = $model;
        }
        return $models;
    }

    public function save(): bool
    {
        $data = get_object_vars($this);
        unset($data['db']);
        if (isset($data[static::$primaryKey]) && !empty($data[static::$primaryKey])) {
            // Update
            $id = $data[static::$primaryKey];
            unset($data[static::$primaryKey]);
            return $this->db->update(static::$table, $data, [static::$primaryKey => $id]) > 0;
        } else {
            // Insert
            $this->db->insert(static::$table, $data);
            $this->{static::$primaryKey} = $this->db->lastInsertId();
            return true;
        }
    }

    public function delete(): bool
    {
        if (isset($this->{static::$primaryKey})) {
            return $this->db->delete(static::$table, [static::$primaryKey => $this->{static::$primaryKey}]) > 0;
        }
        return false;
    }

    public static function where(array $conditions): array
    {
        $instance = new static();
        $whereClauses = [];
        $params = [];
        foreach ($conditions as $col => $val) {
            $whereClauses[] = "$col = ?";
            $params[] = $val;
        }
        $sql = "SELECT * FROM " . static::$table . " WHERE " . implode(' AND ', $whereClauses);
        $rows = $instance->db->query($sql, $params)->fetchAll();
        $models = [];
        foreach ($rows as $row) {
            $model = new static();
            foreach ($row as $key => $value) {
                $model->$key = $value;
            }
            $models[] = $model;
        }
        return $models;
    }
}