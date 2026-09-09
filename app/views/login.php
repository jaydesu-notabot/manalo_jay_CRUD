<?php $message = htmlspecialchars($message ?? '', ENT_QUOTES, 'UTF-8'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Product Manager Login</title>
    <link rel="stylesheet" href="<?= site_url('/css/app.css') ?>">
</head>
<body class="login-page">
    <main class="panel login-card">
        <p class="eyebrow">Inventory workspace</p>
        <h1>Welcome back.</h1>
        <p class="lead">Sign in to manage your product inventory.</p>
        <?php if ($message !== ''): ?>
            <div class="toast error" role="alert"><span><?= $message ?></span><button class="toast-close" type="button" aria-label="Close notification" onclick="this.parentElement.remove()">×</button></div>
        <?php endif; ?>
        <form action="<?= site_url('/login') ?>" method="post">
            <label for="username">Username</label>
            <input id="username" name="username" required autocomplete="username">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">
            <button type="submit">Sign in <span aria-hidden="true">→</span></button>
        </form>
        <p class="hint">Use your static account: <strong>admin</strong> / <strong>admin</strong></p>
    </main>
</body>
</html>
