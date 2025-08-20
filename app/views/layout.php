<?php $config=require __DIR__.'/../config/config.php'; $base=rtrim($config['app']['base_url'],'/'); ?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($title??'Argentix Genève') ?></title><link rel="stylesheet" href="<?= $base ?>/assets/css/style.css"></head><body>
<header class="topbar"><a class="brand" href="<?= url('home','index') ?>">Argentix Genève</a><nav>
<a href="<?= url('product','index') ?>">Catalogue</a><a href="<?= url('cart','index') ?>">Panier</a>
<?php if(!empty($_SESSION['user'])): ?><a href="<?= url('admin','index') ?>">Admin</a><a href="<?= url('auth','logout') ?>">Déconnexion</a><?php else: ?>
<a href="<?= url('auth','login') ?>">Connexion</a><?php endif; ?></nav></header>
<main class="container"><?php require $viewPath; ?></main><footer class="footer"><small>© <?= date('Y') ?> Argentix Genève</small></footer></body></html>