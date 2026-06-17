<?php
return [
    'default' => getenv('DB_CONNECTION') ?: 'mysql',
    'mysql' => [
        'host' => getenv('DB_HOST') ?: '127.0.0.1',
        'port' => getenv('DB_PORT') ?: '3306',
        'database' => getenv('DB_DATABASE') ?: 'autopublisherx',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],
    'sqlite' => [
        'path' => BASE_PATH . '/database/sqlite.db',
    ],
];