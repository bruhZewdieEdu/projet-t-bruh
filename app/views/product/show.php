<h1><?= htmlspecialchars($product['name']) ?></h1>
<p class="muted">Marque : <strong><?= htmlspecialchars($product['brand_name']) ?></strong></p>
<p>État : <?= htmlspecialchars($product['condition']) ?> — Format : <?= htmlspecialchars($product['format']) ?></p>
<p class="price">Prix : <?= number_format($product['price_chf'], 2, '.', "'") ?> CHF</p>
<p class="stack"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
<p><a class="btn" href="<?= url('cart','add', ['id'=>$product['id']]) ?>">Ajouter au panier</a></p>
