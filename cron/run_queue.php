<?php
require __DIR__ . '/../public/index.php';
$runner = new \App\Queue\JobRunner();
while ($runner->processNext()) {
    // Continue processing
}