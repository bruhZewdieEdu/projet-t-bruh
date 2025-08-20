<h1>Catalogue</h1><div class="grid"><?php foreach($products as $p): ?><div class="card">
<h3><?= htmlspecialchars($p['name']) ?></h3><p><strong><?= htmlspecialchars($p['brand_name']) ?></strong> — État <?= htmlspecialchars($p['condition']) ?> — <?= htmlspecialchars($p['format']) ?></p>
<p class="price"><?= number_format($p['price_chf'],2,'.',"'") ?> CHF</p><p><a class="btn" href="<?= url('product','show',['id'=>$p['id']]) ?>">Détails</a>
<a class="btn outline" href="<?= url('cart','add',['id'=>$p['id']]) ?>">Ajouter</a></p></div><?php endforeach; ?></div>