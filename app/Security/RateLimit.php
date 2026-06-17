<?php
namespace App\Security;

class RateLimit
{
    private string $cacheDir;

    public function __construct()
    {
        $this->cacheDir = BASE_PATH . '/storage/cache/ratelimit/';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    public function check(string $identifier, int $maxRequests, int $windowSeconds): bool
    {
        $key = md5($identifier);
        $file = $this->cacheDir . $key;
        $now = time();
        $data = [];
        if (file_exists($file)) {
            $data = json_decode(file_get_contents($file), true);
            // Remove old entries
            $data = array_filter($data, fn($t) => ($now - $t) < $windowSeconds);
        }
        if (count($data) >= $maxRequests) {
            return false;
        }
        $data[] = $now;
        file_put_contents($file, json_encode($data), LOCK_EX);
        return true;
    }
}