<html lang="en">
<head><meta charset="UTF-8"><title>Edit Article</title><link href="/assets/css/style.css" rel="stylesheet"></head>
<div class="container mt-4" x-data="{}">
    <form method="post" action="/articles/<?= $article->id ?>">
        <input type="hidden" name="_method" value="PUT">
        <?= \App\Security\Csrf::field() ?>
        <div class="mb-3"><label>Title</label><input type="text" name="title" value="<?= htmlspecialchars($article->title) ?>" class="form-control" required></div>
        <div class="mb-3"><label>Content</label><textarea name="content" rows="15" class="form-control" required><?= htmlspecialchars($article->content) ?></textarea></div>
        <button type="submit" class="btn btn-primary">Update</button>