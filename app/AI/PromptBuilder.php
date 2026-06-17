<?php
namespace App\AI;

class PromptBuilder
{
    public static function buildResearchPrompt(string $topic): string
    {
        return "You are an expert researcher. Gather key facts, statistics, and insights about \"$topic\". Provide a structured summary.";
    }

    public static function buildWriterPrompt(string $topic, string $research, string $style = 'informative'): string
    {
        return "Write a comprehensive, SEO-optimized article on \"$topic\" using the following research. Style: $style.\n\nResearch:\n$research";
    }

    public static function buildSeoPrompt(string $content): string
    {
        return "Analyze the following content and suggest improvements for on-page SEO, including meta title, description, headings, and keyword usage.\n\nContent:\n$content";
    }

    public static function buildHumanizerPrompt(string $content): string
    {
        return "Rewrite the following AI-generated content to make it more human-like, engaging, and natural while preserving meaning.\n\n$content";
    }
}