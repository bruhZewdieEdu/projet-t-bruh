<?php require_once __DIR__.'/../models/Product.php'; class CartController extends Controller{
public function index(){ $this->render('cart',['title'=>'Panier','cart'=>($_SESSION['cart']??[])]); }
public function add(){ $id=(int)($_GET['id']??0); $p=(new Product())->find($id); if($p&&$p['is_active']) $_SESSION['cart'][$id]=($_SESSION['cart'][$id]??0)+1; $this->redirect(url('cart','index')); }
public function remove(){ $id=(int)($_GET['id']??0); if(isset($_SESSION['cart'][$id])) unset($_SESSION['cart'][$id]); $this->redirect(url('cart','index')); }
public function clear(){ unset($_SESSION['cart']); $this->redirect(url('cart','index')); }}