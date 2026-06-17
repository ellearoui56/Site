<html lang="en">
<head><meta charset="UTF-8"><title>Articles</title><link href="/assets/css/style.css" rel="stylesheet"><script defer src="/assets/js/alpine.js"></script></head>
<nav class="navbar navbar-dark bg-dark px-3"><a class="navbar-brand" href="/dashboard">AutoPublisher X</a></nav>
<div class="container mt-4" x-data="{ articles: <?= json_encode($articles) ?> }">
    <h2>Articles <a href="/articles/create" class="btn btn-primary btn-sm">New</a></h2>
    <table class="table">
            <template x-for="a in articles" :key="a.id">
                    <td x-text="a.title"></td>
                    <td x-text="a.status"></td>
                        <a :href="'/articles/'+a.id+'/edit'" class="btn btn-sm btn-secondary">Edit</a>
                        <button class="btn btn-sm btn-danger" @click="deleteArticle(a.id)">Del</button>
function deleteArticle(id) { fetch('/articles/'+id, { method:'DELETE' }).then(r => location.reload()); }