<html lang="en">
<head><meta charset="UTF-8"><title>Ad Settings</title><link href="/assets/css/style.css" rel="stylesheet"></head>
<div class="container mt-4">
    <form method="post" action="/ads/save">
        <?= \App\Security\Csrf::field() ?>
        <textarea name="adsense_code" class="form-control" rows="5"></textarea>
        <button type="submit" class="btn btn-success mt-2">Save</button>