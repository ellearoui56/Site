<html lang="en">
    <meta charset="UTF-8">
    <link href="/assets/css/style.css" rel="stylesheet">
    <script defer src="/assets/js/alpine.js"></script>
<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="/dashboard">AutoPublisher X</a>
<div class="container mt-4" x-data="{ stats: <?= json_encode($stats) ?> }">
    <div class="row">
        <div class="col-md-3"><div class="card p-3"><h5>Published</h5><p x-text="stats.articles_published"></p></div></div>
        <div class="col-md-3"><div class="card p-3"><h5>Scheduled</h5><p x-text="stats.articles_scheduled"></p></div></div>
        <div class="col-md-3"><div class="card p-3"><h5>Visitors Today</h5><p x-text="stats.visitors_today"></p></div></div>
        <div class="col-md-3"><div class="card p-3"><h5>AI Requests</h5><p x-text="stats.ai_usage_today"></p></div></div>