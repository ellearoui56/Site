<?php
return function(\App\Core\Database $db) {
    $db->getPdo()->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255),
        email VARCHAR(255) UNIQUE,
        password_hash VARCHAR(255),
        role VARCHAR(50) DEFAULT 'editor',
        site_id INTEGER NULL,
        created_at DATETIME,
    )");
};