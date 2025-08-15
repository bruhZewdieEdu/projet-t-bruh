<h1>Nouveau produit</h1>
<?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="post">
  <label>Marque
    <select name="brand_id">
      <?php foreach ($brands as $b): ?>
        <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Nom <input name="name" required></label>
  <label>État
    <select name="condition">
      <option>A</option><option selected>B</option><option>C</option><option>D</option>
    </select>
  </label>
  <label>Format
    <select name="format">
      <option selected>35mm</option><option>120</option><option>APS</option><option>Autre</option>
    </select>
  </label>
  <label>Prix CHF <input name="price_chf" type="number" step="0.05" min="0" required></label>
  <label>Stock <input name="stock_qty" type="number" min="0" value="0"></label>
  <label>Description <textarea name="description" rows="4"></textarea></label>
  <button class="btn" type="submit">Créer</button>
</form>
