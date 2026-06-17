<?php
namespace App\Helpers;

class DateHelper
{
    public static function humanDiff(string $date): string
    {
        $now = new \DateTime();
        $dt = new \DateTime($date);
        $diff = $now->diff($dt);
        if ($diff->y > 0) return $diff->y . ' years ago';
        if ($diff->m > 0) return $diff->m . ' months ago';
        if ($diff->d > 0) return $diff->d . ' days ago';
        if ($diff->h > 0) return $diff->h . ' hours ago';
        if ($diff->i > 0) return $diff->i . ' minutes ago';
        return 'just now';
    }

    public static function formatForDisplay(string $date, string $format = 'M d, Y'): string
    {
        return (new \DateTime($date))->format($format);
    }

    public static function nextSchedule(array $intervals): array
    {
        // Compute next run times for cron-like expressions
        return [];
    }
}