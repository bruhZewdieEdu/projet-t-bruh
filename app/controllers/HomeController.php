<?php
require_once __DIR__ . '/../models/Product.php';
class HomeController extends Controller {
  public function index() {
    $products = (new Product())->allActive();
    $this->view('home/index', ['title' => 'Accueil', 'products' => $products]);
  }
}
