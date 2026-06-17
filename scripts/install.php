<?php
require __DIR__ . '/../public/index.php';
echo "Running migrations...\n";
$migrations = new \App\Database\Migrations();
$migrations->run();
echo "Seeding...\n";
$seeders = new \App\Database\Seeders();
$seeders->run();
echo "Installation completed.\n";