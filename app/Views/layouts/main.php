<html lang="<?= $lang ?? 'en' ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'AutoPublisher X' ?></title>
    <link href="/assets/css/style.css" rel="stylesheet">
    <script defer src="/assets/js/alpine.js"></script>
    <?= $head ?? '' ?>
<body class="min-vh-100 d-flex flex-column">
    <?php if (isset($navbar)): ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
            <a class="navbar-brand" href="/dashboard">AutoPublisher X</a>
            <div class="ms-auto">
                <?php if (\App\Security\Auth::check()): ?>
                    <span class="text-white me-2"><?= \App\Security\Auth::user()['name'] ?></span>
                    <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
                <?php endif; ?>
    <?php endif; ?>

    <main class="flex-grow-1">
        <?= $content ?>

    <?php if (isset($footer)): ?>
        <footer class="bg-dark text-white text-center py-3 mt-auto">
            <small>&copy; <?= date('Y') ?> AutoPublisher X Enterprise</small>
    <?php endif; ?>