<html lang="en">
<head><meta charset="UTF-8"><title>Settings</title><link href="/assets/css/style.css" rel="stylesheet"></head>
<div class="container mt-4">
    <form method="post" action="/settings">
        <?= \App\Security\Csrf::field() ?>
        <div class="mb-3"><label>Site Name</label><input type="text" name="name" class="form-control"></div>
        <button type="submit" class="btn btn-primary">Update</button>