<?php
require_once __DIR__ . '/../models/Product.php';
class CartController extends Controller {
  public function index() {
    $cart = $_SESSION['cart'] ?? [];
    $this->view('cart/index', ['title' => 'Panier', 'cart' => $cart]);
  }
  public function add() {
    $id = (int)($_GET['id'] ?? 0);
    $product = (new Product())->find($id);
    if ($product && $product['is_active']) {
      $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
    $this->redirect(url('cart', 'index'));
  }
  public function remove() {
    $id = (int)($_GET['id'] ?? 0);
    if (isset($_SESSION['cart'][$id])) unset($_SESSION['cart'][$id]);
    $this->redirect(url('cart', 'index'));
  }
  public function clear() {
    unset($_SESSION['cart']);
    $this->redirect(url('cart', 'index'));
  }
}
