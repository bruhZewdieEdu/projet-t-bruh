<?php
class Router {
  public static function dispatch() {
    session_start();
    $controller = $_GET['c'] ?? 'home';
    $action = $_GET['a'] ?? 'index';
    $controllerClass = ucfirst($controller) . 'Controller';
    $controllerFile = __DIR__ . '/../controllers/' . $controllerClass . '.php';
    if (!file_exists($controllerFile)) { http_response_code(404); echo 'Controller not found'; exit; }
    require_once $controllerFile;
    if (!class_exists($controllerClass)) { http_response_code(500); echo 'Controller class missing'; exit; }
    $instance = new $controllerClass();
    if (!method_exists($instance, $action)) { http_response_code(404); echo 'Action not found'; exit; }
    $instance->$action();
  }
}
