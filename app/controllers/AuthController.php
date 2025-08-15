<?php
require_once __DIR__ . '/../models/User.php';
class AuthController extends Controller {
  private function ensureGuest() {
    if (!empty($_SESSION['user'])) $this->redirect(url('admin','dashboard'));
  }
  public function login() {
    $this->ensureGuest();
    $error = null;
    if ($this->isPost()) {
      $email = trim($_POST['email'] ?? '');
      $pass = $_POST['password'] ?? '';
      $user = (new User())->findByEmail($email);
      if ($user && password_verify($pass, $user['password_hash'])) {
        $_SESSION['user'] = ['id'=>$user['id'], 'email'=>$user['email'], 'role'=>$user['role']];
        $this->redirect(url('admin','dashboard'));
      } else {
        $error = 'Identifiants invalides';
      }
    }
    $this->view('auth/login', ['title'=>'Connexion', 'error'=>$error]);
  }
  public function logout() {
    unset($_SESSION['user']);
    $this->redirect(url('home','index'));
  }
}
