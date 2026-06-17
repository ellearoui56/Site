<?php
// Interactive setup script for first-time configuration
echo "AutoPublisher X Setup\n";
echo "Enter database host [127.0.0.1]: ";
$host = trim(fgets(STDIN)) ?: '127.0.0.1';
// ... save to .env
file_put_contents(BASE_PATH . '/.env', "DB_HOST=$host\n");