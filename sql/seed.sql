-- seed.sql
USE argentix;

INSERT INTO users (email, password_hash, role)
VALUES (
  'admin@argentix.local',
  '$2y$10$2zvH2c1zR7J7sT8oOZV1uO3y2q2r8V4o9b2f4o0iJYtQ7nH8mMpuG',
  'admin'
);

INSERT INTO brands (name) VALUES
  ('Canon'), ('Nikon'), ('Pentax'), ('Minolta'), ('Olympus');

INSERT INTO products (brand_id, name, `condition`, format, price_chf, stock_qty, is_active, description)
VALUES
  ((SELECT id FROM brands WHERE name='Canon'),  'Canon AE-1 Program', 'B', '35mm', 249.00, 3, 1, 'Boîtier révisé, très bon état.'),
  ((SELECT id FROM brands WHERE name='Nikon'),  'Nikon F3',          'A', '35mm', 549.00, 2, 1, 'Viseur HP, contrôle OK.'),
  ((SELECT id FROM brands WHERE name='Pentax'), 'Pentax K1000',      'B', '35mm', 199.00, 5, 1, 'Classique étudiant, fiable.'),
  ((SELECT id FROM brands WHERE name='Minolta'),'Minolta X-700',     'B', '35mm', 229.00, 2, 1, 'Mode P/Auto.'),
  ((SELECT id FROM brands WHERE name='Olympus'),'Olympus OM-1',      'C', '35mm', 189.00, 1, 1, 'Quelques traces d’usage.')
;

INSERT INTO customers (first_name, last_name, email, phone, address, city, zip)
VALUES ('Léa', 'Durand', 'lea@example.com', '+41 79 000 00 00', 'Rue du Rhône 1', 'Genève', '1204');

INSERT INTO orders (customer_id, status, tva_rate, total_chf)
VALUES ((SELECT id FROM customers WHERE email='lea@example.com'), 'confirmed', 8.10, 0.00);

INSERT INTO order_items (order_id, product_id, qty, unit_price_chf)
SELECT o.id, p.id, 1, p.price_chf
FROM orders o
JOIN products p ON p.name IN ('Canon AE-1 Program','Pentax K1000')
WHERE o.customer_id = (SELECT id FROM customers WHERE email='lea@example.com')
LIMIT 2;

UPDATE orders o
JOIN (
  SELECT order_id, SUM(qty * unit_price_chf) AS subtotal
  FROM order_items
  GROUP BY order_id
) x ON x.order_id = o.id
SET o.total_chf = ROUND(x.subtotal * (1 + o.tva_rate/100), 2);
