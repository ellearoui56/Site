<?php
namespace App\Core;

class Logger
{
    private static string $logPath = BASE_PATH . '/storage/logs/';

    public static function info(string $message, array $context = []): void
    {
        self::write('INFO', $message, $context);
    }

    public static function error(string $message, array $context = []): void
    {
        self::write('ERROR', $message, $context);
    }

    public static function debug(string $message, array $context = []): void
    {
        if (Config::get('app.debug', false)) {
            self::write('DEBUG', $message, $context);
        }
    }

    private static function write(string $level, string $message, array $context): void
    {
        $date = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? json_encode($context) : '';
        $line = "[$date] $level: $message $contextStr" . PHP_EOL;
        $logFile = self::$logPath . 'app-' . date('Y-m-d') . '.log';
        if (!is_dir(self::$logPath)) {
            mkdir(self::$logPath, 0755, true);
        }
        file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
    }
}