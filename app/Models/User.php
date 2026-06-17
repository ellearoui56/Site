<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected static string $table = 'users';
    protected static string $primaryKey = 'id';
    
    public ?int $id = null;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $password_hash = null;
    public string $role = 'editor';
    public ?int $site_id = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}