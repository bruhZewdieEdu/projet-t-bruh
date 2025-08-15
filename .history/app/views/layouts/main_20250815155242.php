<?php
$config = require __DIR__ . '/../../config/config.php';
$base = rtrim($config['app']['base_url'], '/');
?><!doctype html>
<html lang="fr"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Argentix Genève') ?></title>
  <link rel="stylesheet" href="<?= $base ?>/assets/css/style.css">
</head><body>
  <?php require __DIR__ . '/../partials/nav.php'; ?>
  <main class="container"><?php require $viewPath; ?></main>
  <footer class="footer"><small>© <?= date('Y') ?> Argentix Genève</small></footer>
</body></html>
