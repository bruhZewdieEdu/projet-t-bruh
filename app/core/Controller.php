<?php
class Controller {
  protected function view(string $view, array $data = []) {
    extract($data);
    $viewPath = __DIR__ . '/../views/' . $view . '.php';
    require __DIR__ . '/../views/layouts/main.php';
  }
  protected function redirect(string $path) {
    header('Location: ' . $path);
    exit;
  }
  protected function isPost(): bool { return $_SERVER['REQUEST_METHOD'] === 'POST'; }
}
