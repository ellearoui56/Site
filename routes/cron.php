<?php
$router = (new \App\Core\App())->getRouter();
// Cron job endpoints
$router->get('/cron/queue', function() {
    $runner = new \App\Queue\JobRunner();
    $runner->processNext();
});