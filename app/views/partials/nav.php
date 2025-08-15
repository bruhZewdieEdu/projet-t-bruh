<?php
$user = $_SESSION['user'] ?? null;
?><header class="topbar">
  <a class="brand" href="<?= url('home','index') ?>">Argentix Genève</a>
  <nav>
    <a href="<?= url('product','index') ?>">Catalogue</a>
    <a href="<?= url('cart','index') ?>">Panier</a>
    <?php if ($user): ?>
      <a href="<?= url('admin','dashboard') ?>">Admin</a>
      <a href="<?= url('auth','logout') ?>">Déconnexion</a>
    <?php else: ?>
      <a href="<?= url('auth','login') ?>">Connexion</a>
    <?php endif; ?>
  </nav>
</header>
