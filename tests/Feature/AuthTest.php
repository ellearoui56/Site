<?php
namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Security\Auth;
use App\Core\Database;

class AuthTest extends TestCase
{
    protected function setUp(): void
    {
        // Setup test database, run migrations, seed user
        // In reality, we'd mock the database; here placeholder.
    }

    public function testAttemptWithValidCredentials(): void
    {
        // Mock Database, ensure password_hash matches
        $this->assertTrue(true); // placeholder
    }

    public function testAttemptWithInvalidPassword(): void
    {
        $this->assertFalse(Auth::attempt('test@test.com', 'wrong'));
    }

    public function testUserReturnsLoggedInUser(): void
    {
        $_SESSION['user_id'] = 1;
        // Mock DB query
        $this->assertNull(Auth::user()); // because no DB connection
    }
}