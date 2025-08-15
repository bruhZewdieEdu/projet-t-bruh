<h1>Connexion</h1>
<?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="post">
  <label>Email <input type="email" name="email" required></label>
  <label>Mot de passe <input type="password" name="password" required></label>
  <button class="btn" type="submit">Se connecter</button>
</form>
<p>Admin par défaut : admin@argentix.local / admin123</p>
