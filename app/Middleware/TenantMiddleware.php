<?php
namespace App\Middleware;

use App\Core\Config;

class TenantMiddleware
{
    public function handle(): bool
    {
        // For multi-tenant: resolve site from domain/subdomain and set into config
        $host = $_SERVER['HTTP_HOST'] ?? 'default';
        $sites = Config::get('sites.list', []);
        $siteId = null;
        foreach ($sites as $id => $site) {
            if ($site['domain'] === $host) {
                $siteId = $id;
                break;
            }
        }
        if ($siteId) {
            Config::set('app.current_site_id', $siteId);
            Config::set('app.current_site', $sites[$siteId]);
        } else {
            // fallback to first or default
            Config::set('app.current_site_id', key($sites));
        }
        return true;
    }
}