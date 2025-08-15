<?php
require_once __DIR__ . '/../core/Model.php';
class Brand extends Model {
  public function all(): array {
    return $this->db->query("SELECT * FROM brands ORDER BY name")->fetchAll();
  }
  public function create(string $name): bool {
    $stmt = $this->db->prepare("INSERT INTO brands (name) VALUES (?)");
    return $stmt->execute([$name]);
  }
  public function delete(int $id): bool {
    $count = $this->db->prepare("SELECT COUNT(*) FROM products WHERE brand_id=?");
    $count->execute([$id]);
    if ((int)$count->fetchColumn() > 0) return false;
    $stmt = $this->db->prepare("DELETE FROM brands WHERE id=?");
    return $stmt->execute([$id]);
  }
}
