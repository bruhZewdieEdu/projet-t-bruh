<?php
$total = 0.0;
$db = Database::getConnection();
$items = [];
$cart = $cart ?? [];
if (!empty($cart)) {
  $ids = implode(',', array_map('intval', array_keys($cart)));
  $stmt = $db->query("SELECT p.id, p.name, p.price_chf FROM products p WHERE p.id IN ($ids)");
  while ($row = $stmt->fetch()) {
    $qty = $cart[$row['id']];
    $line = $qty * (float)$row['price_chf'];
    $total += $line;
    $items[] = ['id'=>$row['id'], 'name'=>$row['name'], 'qty'=>$qty, 'price'=>$row['price_chf'], 'line'=>$line];
  }
}
?>
<h1>Panier</h1>
<?php if (empty($items)): ?>
  <p>Votre panier est vide.</p>
<?php else: ?>
  <table class="table">
    <thead><tr><th>Produit</th><th>Qté</th><th>Prix</th><th>Total</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($items as $it): ?>
      <tr>
        <td><?= htmlspecialchars($it['name']) ?></td>
        <td><?= (int)$it['qty'] ?></td>
        <td><?= number_format($it['price'], 2, '.', "'") ?> CHF</td>
        <td><?= number_format($it['line'], 2, '.', "'") ?> CHF</td>
        <td><a href="<?= url('cart','remove',['id'=>$it['id']]) ?>">Retirer</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <p><strong>Sous-total :</strong> <?= number_format($total, 2, '.', "'") ?> CHF</p>
  <p>
    <a class="btn outline" href="<?= url('cart','clear') ?>">Vider</a>
    <a class="btn" href="<?= url('order','checkout') ?>">Commander</a>
  </p>
<?php endif; ?>
