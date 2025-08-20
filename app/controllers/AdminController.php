<?php require_once __DIR__.'/../models/Product.php'; require_once __DIR__.'/../models/Brand.php'; class AdminController extends Controller{
private function auth(){ if(empty($_SESSION['user'])) $this->redirect(url('auth','login')); }
public function index(){ $this->auth(); $this->render('admin',['title'=>'Admin']); }
public function products(){ $this->auth(); $p=(new Product())->allActive(); $this->render('admin_products',['title'=>'Produits','products'=>$p]); }
public function productCreate(){ $this->auth(); $brands=(new Brand())->all(); $error=null;
if($_SERVER['REQUEST_METHOD']==='POST'){ $d=['brand_id'=>(int)($_POST['brand_id']??0),'name'=>trim($_POST['name']??''),'condition'=>$_POST['condition']??'B','format'=>$_POST['format']??'35mm','price_chf'=>(float)($_POST['price_chf']??0),'stock_qty'=>(int)($_POST['stock_qty']??0),'is_active'=>1,'description'=>trim($_POST['description']??'')];
if($d['name']===''||$d['price_chf']<=0){ $error='Nom et prix requis (prix>0).'; } else { (new Product())->create($d); $this->redirect(url('admin','products')); } }
$this->render('admin_product_form',['title'=>'Nouveau produit','brands'=>$brands,'error'=>$error]); }
public function productEdit(){ $this->auth(); $id=(int)($_GET['id']??0); $m=new Product(); $prod=$m->find($id); $brands=(new Brand())->all(); $error=null;
if(!$prod){ echo 'Produit introuvable'; return; } if($_SERVER['REQUEST_METHOD']==='POST'){ $d=['brand_id'=>(int)($_POST['brand_id']??0),'name'=>trim($_POST['name']??''),'condition'=>$_POST['condition']??'B','format'=>$_POST['format']??'35mm','price_chf'=>(float)($_POST['price_chf']??0),'stock_qty'=>(int)($_POST['stock_qty']??0),'is_active'=>isset($_POST['is_active'])?1:0,'description'=>trim($_POST['description']??'')];
if($d['name']===''||$d['price_chf']<=0){ $error='Nom et prix requis (prix>0).'; } else { $m->update($id,$d); $this->redirect(url('admin','products')); } }
$this->render('admin_product_form',['title'=>'Éditer produit','brands'=>$brands,'product'=>$prod,'error'=>$error]); }
public function productDelete(){ $this->auth(); (new Product())->softDelete((int)($_GET['id']??0)); $this->redirect(url('admin','products')); }
public function brands(){ $this->auth(); $this->render('admin_brands',['title'=>'Marques','brands'=>(new Brand())->all()]); }
public function brandCreate(){ $this->auth(); if($_SERVER['REQUEST_METHOD']==='POST'){ $n=trim($_POST['name']??''); if($n!=='')(new Brand())->create($n); } $this->redirect(url('admin','brands')); }
public function brandDelete(){ $this->auth(); (new Brand())->delete((int)($_GET['id']??0)); $this->redirect(url('admin','brands')); }}