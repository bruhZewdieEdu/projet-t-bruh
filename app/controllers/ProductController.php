<?php
require_once __DIR__ . '/../models/Product.php';
class ProductController extends Controller {
  public function index() {
    $products = (new Product())->allActive();
    $this->view('product/index', ['title' => 'Catalogue', 'products' => $products]);
  }
  public function show() {
    $id = (int)($_GET['id'] ?? 0);
    $product = (new Product())->find($id);
    if (!$product || !$product['is_active']) { http_response_code(404); echo 'Produit introuvable'; return; }
    $this->view('product/show', ['title' => $product['name'], 'product' => $product]);
  }
}
