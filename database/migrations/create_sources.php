<?php
return function(\App\Core\Database $db) {
    $db->getPdo()->exec("CREATE TABLE IF NOT EXISTS content_sources (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255),
        type VARCHAR(50),
        url TEXT,
        css_selector TEXT,
        xpath TEXT,
        trust_score INTEGER DEFAULT 50,
    )");
};