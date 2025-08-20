<?php require_once __DIR__.'/../models/Product.php'; class ProductController extends Controller{
public function index(){ $p=(new Product())->allActive(); $this->render('products',['title'=>'Catalogue','products'=>$p]); }
public function show(){ $id=(int)($_GET['id']??0); $prod=(new Product())->find($id); if(!$prod||!$prod['is_active']){ http_response_code(404); echo 'Produit introuvable'; return; }
$this->render('product_show',['title'=>$prod['name'],'product'=>$prod]); }}