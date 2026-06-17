<?php
namespace App\Modules\Publisher\PlatformAdapters;

use App\Core\Config;

class WordpressAdapter
{
    private string $apiUrl;
    private string $username;
    private string $password;

    public function __construct()
    {
        $this->apiUrl = Config::get('publisher.wordpress.api_url');
        $this->username = Config::get('publisher.wordpress.username');
        $this->password = Config::get('publisher.wordpress.password');
    }

    public function post(array $article): void
    {
        // Use WordPress REST API
        $url = $this->apiUrl . '/posts';
        $data = [
            'title' => $article['title'],
            'content' => $article['content'],
            'status' => 'publish',
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_exec($ch);
        curl_close($ch);
    }
}