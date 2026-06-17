<?php
require __DIR__ . '/../public/index.php';
$seo = new \App\Modules\SEO\SeoService();
$seo->buildInternalLinks();
// Generate sitemap
$generator = new \App\Modules\SEO\SitemapGenerator();
$generator->generate();