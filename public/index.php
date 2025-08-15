<?php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/config/config.php';

$config = require __DIR__ . '/../app/config/config.php';
$base = rtrim($config['app']['base_url'], '/');
function url(string $c = 'home', string $a = 'index', array $params = []) {
  global $base;
  $query = http_build_query(array_merge(['c' => $c, 'a' => $a], $params));
  return $base . '/index.php?' . $query;
}
Router::dispatch();
