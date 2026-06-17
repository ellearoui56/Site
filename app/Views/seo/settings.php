<html lang="en">
<head><meta charset="UTF-8"><title>SEO Settings</title><link href="/assets/css/style.css" rel="stylesheet"><script defer src="/assets/js/alpine.js"></script></head>
<nav class="navbar navbar-dark bg-dark px-3"><a class="navbar-brand" href="/dashboard">AutoPublisher X</a></nav>
<div class="container mt-4" x-data="{}">
    <button class="btn btn-warning" @click="generateSitemap()">Generate Sitemap</button>
    <button class="btn btn-info" @click="buildLinks()">Rebuild Internal Links</button>
function generateSitemap() { fetch('/seo/generate-sitemap').then(r => alert('Done')); }
function buildLinks() { fetch('/seo/internal-linking').then(r => alert('Links updated')); }