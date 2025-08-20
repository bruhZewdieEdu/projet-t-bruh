<h1><?= isset($product)?'Éditer':'Nouveau' ?> produit</h1><?php if(!empty($error)): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="post"><label>Marque <select name="brand_id"><?php foreach($brands as $b): ?><option value="<?= $b['id'] ?>" <?= isset($product)&&$product['brand_id']==$b['id']?'selected':'' ?>><?= htmlspecialchars($b['name']) ?></option><?php endforeach; ?></select></label>
<label>Nom <input name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required></label>
<label>État <select name="condition"><?php foreach(['A','B','C','D'] as $c): ?><option <?= isset($product)&&$product['condition']==$c?'selected':'' ?>><?= $c ?></option><?php endforeach; ?></select></label>
<label>Format <select name="format"><?php foreach(['35mm','120','APS','Autre'] as $f): ?><option <?= isset($product)&&$product['format']==$f?'selected':'' ?>><?= $f ?></option><?php endforeach; ?></select></label>
<label>Prix CHF <input name="price_chf" type="number" step="0.05" min="0" value="<?= htmlspecialchars($product['price_chf'] ?? '') ?>" required></label>
<label>Stock <input name="stock_qty" type="number" min="0" value="<?= (int)($product['stock_qty'] ?? 0) ?>"></label>
<label><input type="checkbox" name="is_active" <?= !isset($product) || !empty($product['is_active']) ? 'checked':'' ?>> Actif</label>
<label>Description <textarea name="description" rows="4"><?= htmlspecialchars($product['description'] ?? '') ?></textarea></label>
<button class="btn" type="submit"><?= isset($product)?'Enregistrer':'Créer' ?></button></form>