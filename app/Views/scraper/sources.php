<html lang="en">
<head><meta charset="UTF-8"><title>Sources</title><link href="/assets/css/style.css" rel="stylesheet"><script defer src="/assets/js/alpine.js"></script></head>
<div class="container mt-4" x-data="{ sources: <?= json_encode($sources) ?> }">
    <table class="table">
            <template x-for="src in sources" :key="src.id">
                    <td x-text="src.name"></td>
                    <td x-text="src.type"></td>
                    <td x-text="src.trust_score"></td>
                    <td><button class="btn btn-sm btn-primary" @click="scrape(src.id)">Scrape Now</button></td>
function scrape(id) { fetch('/scraper/scrape/'+id).then(r => alert('Scraping started')); }