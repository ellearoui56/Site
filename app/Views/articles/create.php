<html lang="en">
<head><meta charset="UTF-8"><title>Create Article</title><link href="/assets/css/style.css" rel="stylesheet"></head>
<div class="container mt-4">
    <form method="post" action="/articles/store">
        <?= \App\Security\Csrf::field() ?>
        <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
        <div class="mb-3"><label>Content</label><textarea name="content" rows="10" class="form-control" required></textarea></div>
        <button type="submit" class="btn btn-success">Save Draft</button>