<?php require_once __DIR__.'/../core/Model.php'; class Brand extends Model{
public function all():array{ return $this->db->query("SELECT * FROM brands ORDER BY name")->fetchAll(); }
public function create(string $n):bool{ return $this->db->prepare("INSERT INTO brands (name) VALUES (?)")->execute([$n]); }
public function delete(int $id):bool{ $c=$this->db->prepare("SELECT COUNT(*) FROM products WHERE brand_id=?"); $c->execute([$id]); if((int)$c->fetchColumn()>0)return False; return $this->db->prepare("DELETE FROM brands WHERE id=?")->execute([$id]); } }