<h1>Produits</h1><p><a class="btn" href="<?= url('admin','productCreate') ?>">Nouveau produit</a></p>
<table class="table"><thead><tr><th>Nom</th><th>Prix</th><th>Stock</th><th></th></tr></thead><tbody>
<?php foreach($products as $p): ?><tr><td><?= htmlspecialchars($p['name']) ?></td><td><?= number_format($p['price_chf'],2,'.',"'") ?> CHF</td><td><?= (int)$p['stock_qty'] ?></td>
<td><a href="<?= url('admin','productEdit',['id'=>$p['id']]) ?>">Éditer</a> | <a href="<?= url('admin','productDelete',['id'=>$p['id']]) ?>" onclick="return confirm('Supprimer (logique) ?')">Supprimer</a></td></tr><?php endforeach; ?>
</tbody></table>