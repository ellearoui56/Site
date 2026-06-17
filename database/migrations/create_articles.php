<?php
return function(\App\Core\Database $db) {
    $db->getPdo()->exec("CREATE TABLE IF NOT EXISTS articles (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        site_id INTEGER,
        title VARCHAR(500),
        slug VARCHAR(500),
        content LONGTEXT,
        meta_description TEXT,
        featured_image VARCHAR(500),
        status VARCHAR(50) DEFAULT 'draft',
        source_url TEXT,
        published_at DATETIME,
        created_at DATETIME,
    )");
};