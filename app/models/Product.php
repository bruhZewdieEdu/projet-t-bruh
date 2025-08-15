<?php
require_once __DIR__ . '/../core/Model.php';
class Product extends Model {
  public function allActive(): array {
    $stmt = $this->db->query("SELECT p.*, b.name AS brand_name
                              FROM products p
                              JOIN brands b ON b.id = p.brand_id
                              WHERE p.is_active = 1
                              ORDER BY p.created_at DESC");
    return $stmt->fetchAll();
  }
  public function find(int $id) {
    $stmt = $this->db->prepare("SELECT p.*, b.name AS brand_name
                                FROM products p
                                JOIN brands b ON b.id = p.brand_id
                                WHERE p.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
  }
  public function create(array $data): bool {
    $sql = "INSERT INTO products (brand_id, name, `condition`, format, price_chf, stock_qty, is_active, description)
            VALUES (:brand_id, :name, :condition, :format, :price_chf, :stock_qty, :is_active, :description)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($data);
  }
  public function update(int $id, array $data): bool {
    $sql = "UPDATE products
            SET brand_id=:brand_id, name=:name, `condition`=:condition, format=:format,
                price_chf=:price_chf, stock_qty=:stock_qty, is_active=:is_active, description=:description
            WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $data['id'] = $id;
    return $stmt->execute($data);
  }
  public function softDelete(int $id): bool {
    $stmt = $this->db->prepare("UPDATE products SET is_active = 0 WHERE id = ?");
    return $stmt->execute([$id]);
  }
}
