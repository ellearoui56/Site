<?php
return function(\App\Core\Database $db) {
    $db->getPdo()->exec("CREATE TABLE IF NOT EXISTS queue_jobs (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        job_class VARCHAR(255),
        payload TEXT,
        available_at DATETIME,
        reserved_at DATETIME NULL,
        failed_at DATETIME NULL,
        error TEXT NULL,
    )");
};