<?php
require __DIR__ . '/../public/index.php';
// Clean old logs, temp files
$logPath = BASE_PATH . '/storage/logs/';
$files = glob($logPath . '*.log');
foreach ($files as $file) {
    if (time() - filemtime($file) > 86400 * 30) { // older 30 days
        unlink($file);
    }
}