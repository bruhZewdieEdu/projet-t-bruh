<?php
require_once __DIR__ . '/../core/Model.php';
class User extends Model {
  public function findByEmail(string $email) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
  }
}
