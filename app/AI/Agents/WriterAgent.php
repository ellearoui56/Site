<?php
namespace App\AI\Agents;

use App\AI\AIClient;

class WriterAgent
{
    public function write(string $topic, string $research, string $style): string
    {
        $client = new AIClient();
        $prompt = "Write a $style article about \"$topic\" using the following research:\n$research\nInclude introduction, headings, and conclusion.";
        return $client->chatCompletion([
            ['role' => 'user', 'content' => $prompt]
        ]);
    }
}