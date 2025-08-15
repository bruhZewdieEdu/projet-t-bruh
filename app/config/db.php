<?php
class Database {
  private static ?PDO $pdo = null;
  public static function getConnection(): PDO {
    if (self::$pdo === null) {
      $config = require __DIR__ . '/config.php';
      $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'] . ';charset=' . $config['db']['charset'];
      self::$pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]);
    }
    return self::$pdo;
  }
}
