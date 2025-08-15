<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';
class AdminController extends Controller {
  private function ensureAuth() {
    if (empty($_SESSION['user'])) {
      $this->redirect(url('auth', 'login'));
    }
  }
  public function dashboard() {
    $this->ensureAuth();
    $this->view('admin/index', ['title' => 'Admin']);
  }
  public function products() {
    $this->ensureAuth();
    $model = new Product();
    $products = $model->allActive();
    $this->view('admin/products/index', ['title'=>'Produits', 'products'=>$products]);
  }
  public function productCreate() {
    $this->ensureAuth();
    $brands = (new Brand())->all();
    $error = null;
    if ($this->isPost()) {
      $data = [
        'brand_id' => (int)($_POST['brand_id'] ?? 0),
        'name' => trim($_POST['name'] ?? ''),
        'condition' => $_POST['condition'] ?? 'B',
        'format' => $_POST['format'] ?? '35mm',
        'price_chf' => (float)($_POST['price_chf'] ?? 0),
        'stock_qty' => (int)($_POST['stock_qty'] ?? 0),
        'is_active' => 1,
        'description' => trim($_POST['description'] ?? ''),
      ];
      if ($data['name']==='' or $data['price_chf']<=0) {
        $error = 'Nom et prix doivent être renseignés (prix > 0).';
      } else {
        (new Product())->create($data);
        $this->redirect(url('admin','products'));
      }
    }
    $this->view('admin/products/create', ['title'=>'Nouveau produit', 'brands'=>$brands, 'error'=>$error]);
  }
  public function productEdit() {
    $this->ensureAuth();
    $id = (int)($_GET['id'] ?? 0);
    $model = new Product();
    $product = $model->find($id);
    $brands = (new Brand())->all();
    $error = null;
    if (!$product) { echo 'Produit introuvable'; return; }
    if ($this->isPost()) {
      $data = [
        'brand_id' => (int)($_POST['brand_id'] ?? 0),
        'name' => trim($_POST['name'] ?? ''),
        'condition' => $_POST['condition'] ?? 'B',
        'format' => $_POST['format'] ?? '35mm',
        'price_chf' => (float)($_POST['price_chf'] ?? 0),
        'stock_qty' => (int)($_POST['stock_qty'] ?? 0),
        'is_active' => isset($_POST['is_active']) ? 1 : 0,
        'description' => trim($_POST['description'] ?? ''),
      ];
      if ($data['name']==='' or $data['price_chf']<=0) {
        $error = 'Nom et prix doivent être renseignés (prix > 0).';
      } else {
        $model->update($id, $data);
        $this->redirect(url('admin','products'));
      }
    }
    $this->view('admin/products/edit', ['title'=>'Éditer produit', 'product'=>$product, 'brands'=>$brands, 'error'=>$error]);
  }
  public function productDelete() {
    $this->ensureAuth();
    $id = (int)($_GET['id'] ?? 0);
    (new Product())->softDelete($id);
    $this->redirect(url('admin','products'));
  }
  public function brands() {
    $this->ensureAuth();
    $brands = (new Brand())->all();
    $this->view('admin/brands/index', ['title'=>'Marques', 'brands'=>$brands]);
  }
  public function brandCreate() {
    $this->ensureAuth();
    if ($this->isPost()) {
      $name = trim($_POST['name'] ?? '');
      if ($name !== '') (new Brand())->create($name);
      $this->redirect(url('admin','brands'));
    }
    $this->view('admin/brands/index', ['title'=>'Marques', 'brands'=>(new Brand())->all()]);
  }
  public function brandDelete() {
    $this->ensureAuth();
    $id = (int)($_GET['id'] ?? 0);
    (new Brand())->delete($id);
    $this->redirect(url('admin','brands'));
  }
}
