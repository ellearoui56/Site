<?php
namespace App\AI;

use App\Core\Config;

class AIClient
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = Config::get('ai.openai.api_key');
        $this->baseUrl = Config::get('ai.openai.base_url', 'https://api.openai.com/v1');
    }

    public function chatCompletion(array $messages, string $model = 'gpt-4', float $temperature = 0.7): string
    {
        $url = $this->baseUrl . '/chat/completions';
        $payload = [
            'model' => $model,
            'messages' => $messages,
            'temperature' => $temperature,
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new \RuntimeException("AI API error: $response");
        }
        $data = json_decode($response, true);
        return $data['choices'][0]['message']['content'] ?? '';
    }

    public function generateImage(string $prompt, string $size = '1024x1024'): ?string
    {
        // DALL-E or other
        $url = $this->baseUrl . '/images/generations';
        $payload = [
            'prompt' => $prompt,
            'n' => 1,
            'size' => $size,
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        return $data['data'][0]['url'] ?? null;
    }
}