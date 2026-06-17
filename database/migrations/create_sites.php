<?php
return function(\App\Core\Database $db) {
    $db->getPdo()->exec("CREATE TABLE IF NOT EXISTS sites (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        domain VARCHAR(255) UNIQUE,
        name VARCHAR(255),
        settings TEXT,
    )");
};