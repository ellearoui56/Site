<?php
namespace App\Modules\Ads;

use App\Core\Config;

class AdsService
{
    public function updateSettings(array $data): void
    {
        Config::set('ads.adsense_code', $data['adsense_code']);
        // Save config permanently
        file_put_contents(BASE_PATH . '/config/ads.php', '<?php return ' . var_export(Config::get('ads'), true) . ';');
    }
}