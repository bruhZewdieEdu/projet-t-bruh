<?php
class OrderController extends Controller {
  public function checkout() {
    $this->view('order/checkout', ['title' => 'Commande']);
  }
}
