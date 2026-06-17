<?php
namespace App\Core;

class View
{
    public static function render(string $template, array $data = []): string
    {
        $templatePath = BASE_PATH . '/app/Views/' . str_replace('.', '/', $template) . '.php';
        if (!file_exists($templatePath)) {
            throw new \RuntimeException("View $template not found.");
        }
        extract($data);
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }
}