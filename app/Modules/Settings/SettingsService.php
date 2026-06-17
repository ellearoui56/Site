<?php
namespace App\Modules\Settings;

use App\Core\Config;

class SettingsService
{
    public function update(array $data): void
    {
        foreach ($data as $key => $value) {
            Config::set('app.' . $key, $value);
        }
        // Save app config
        file_put_contents(BASE_PATH . '/config/app.php', '<?php return ' . var_export(Config::get('app'), true) . ';');
    }
}