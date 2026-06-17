<?php
namespace App\AI;

class ResponseParser
{
    public static function extractJson(string $response): array
    {
        // Extract JSON block from markdown if present
        if (preg_match('/```json(.*?)```/s', $response, $matches)) {
            $json = trim($matches[1]);
            return json_decode($json, true) ?? [];
        }
        // Try to parse whole as JSON
        $decoded = json_decode($response, true);
        return $decoded ?? ['raw' => $response];
    }

    public static function extractSections(string $response): array
    {
        $sections = [];
        $lines = explode("\n", $response);
        $current = '';
        foreach ($lines as $line) {
            if (preg_match('/^##\s+(.+)/', $line, $m)) {
                if ($current) $sections[] = trim($current);
                $current = $line . "\n";
            } else {
                $current .= $line . "\n";
            }
        }
        if ($current) $sections[] = trim($current);
        return $sections;
    }
}