<html lang="en">
    <meta charset="UTF-8">
    <link href="/assets/css/style.css" rel="stylesheet">
    <script defer src="/assets/js/alpine.js"></script>
<body class="bg-light">
<div class="container mt-5" x-data="{ email:'', password:'' }">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-4">Sign In</h2>
            <form method="post" action="/login">
                <?= \App\Security\Csrf::field() ?>
                <div class="mb-3">
                    <input type="email" name="email" x-model="email" class="form-control" required>
                <div class="mb-3">
                    <input type="password" name="password" x-model="password" class="form-control" required>
                <button type="submit" class="btn btn-primary w-100">Login</button>