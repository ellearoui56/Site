<?php
$router = (new \App\Core\App())->getRouter();

$router->group('/api', function($router) {
    $router->get('/stats', [\App\Modules\Dashboard\DashboardController::class, 'apiStats']);
    $router->post('/article/generate', [\App\Modules\Articles\ArticleController::class, 'generate']);
    $router->post('/publish/{id}', [\App\Modules\Publisher\PublisherController::class, 'publish']);
});