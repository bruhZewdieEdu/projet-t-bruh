<?php $error=null; $done=false; if($_SERVER['REQUEST_METHOD']==='POST'){ $db=Database::getConnection(); $db->beginTransaction();
try{ $fn=trim($_POST['first_name']??''); $ln=trim($_POST['last_name']??''); $email=trim($_POST['email']??'');
if($fn===''||$ln===''||$email==='') throw new Exception('Champs requis manquants');
$db->prepare("INSERT INTO customers (first_name,last_name,email,phone,address,city,zip) VALUES (?,?,?,?,?,?,?)")->execute([$fn,$ln,$email,$_POST['phone']??null,$_POST['address']??null,$_POST['city']??null,$_POST['zip']??null]);
$customer_id=(int)$db->lastInsertId(); $db->exec("INSERT INTO orders (customer_id,status,total_chf) VALUES ($customer_id,'draft',0.00)");
$order_id=(int)$db->lastInsertId(); $cart=$_SESSION['cart']??[]; if(empty($cart)) throw new Exception('Panier vide');
$ids=implode(',',array_map('intval',array_keys($cart))); $ps=$db->query("SELECT id,price_chf FROM products WHERE id IN ($ids)")->fetchAll();
$subtotal=0.0; $st=$db->prepare("INSERT INTO order_items (order_id,product_id,qty,unit_price_chf) VALUES (?,?,?,?)");
foreach($ps as $p){ $q=(int)$cart[$p['id']]; $st->execute([$order_id,$p['id'],$q,$p['price_chf']]); $subtotal+=$q*(float)$p['price_chf']; }
$tva=(float)$db->query("SELECT tva_rate FROM orders WHERE id=$order_id")->fetch()['tva_rate']; $total=round($subtotal*(1+$tva/100),2);
$db->prepare("UPDATE orders SET total_chf=?, status='confirmed' WHERE id=?")->execute([$total,$order_id]); $db->commit(); unset($_SESSION['cart']); $done=true;
}catch(Exception $e){ $db->rollBack(); $error=$e->getMessage(); } } ?>
<h1>Commande</h1><?php if($done): ?><p>Merci ! Votre commande a été enregistrée.</p><p><a class="btn" href="<?= url('home','index') ?>">Retour à l'accueil</a></p>
<?php else: ?><?php if($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="post"><div class="grid-2">
<label>Prénom* <input name="first_name" required></label><label>Nom* <input name="last_name" required></label>
<label>Email* <input name="email" type="email" required></label><label>Téléphone <input name="phone"></label>
<label>Adresse <input name="address"></label><label>Ville <input name="city"></label><label>NPA <input name="zip"></label>
</div><button class="btn" type="submit">Valider la commande</button></form><?php endif; ?>