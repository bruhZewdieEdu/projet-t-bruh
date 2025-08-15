-- schema.sql
DROP DATABASE IF EXISTS argentix;
CREATE DATABASE argentix CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE argentix;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','staff') NOT NULL DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE brands (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE products (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  brand_id INT UNSIGNED NOT NULL,
  name VARCHAR(150) NOT NULL,
  `condition` ENUM('A','B','C','D') NOT NULL DEFAULT 'B',
  format ENUM('35mm','120','APS','Autre') NOT NULL DEFAULT '35mm',
  price_chf DECIMAL(10,2) NOT NULL,
  stock_qty INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_products_brand
    FOREIGN KEY (brand_id) REFERENCES brands(id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  INDEX idx_products_brand (brand_id),
  INDEX idx_products_active (is_active)
) ENGINE=InnoDB;

CREATE TABLE customers (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(80) NOT NULL,
  last_name VARCHAR(80) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(40),
  address VARCHAR(190),
  city VARCHAR(100),
  zip VARCHAR(20),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_customers_email (email)
) ENGINE=InnoDB;

CREATE TABLE orders (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  customer_id INT UNSIGNED NOT NULL,
  order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status ENUM('draft','confirmed','cancelled') NOT NULL DEFAULT 'draft',
  tva_rate DECIMAL(4,2) NOT NULL DEFAULT 8.10,
  total_chf DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  CONSTRAINT fk_orders_customer
    FOREIGN KEY (customer_id) REFERENCES customers(id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  INDEX idx_orders_customer (customer_id),
  INDEX idx_orders_status (status)
) ENGINE=InnoDB;

CREATE TABLE order_items (
  order_id INT UNSIGNED NOT NULL,
  product_id INT UNSIGNED NOT NULL,
  qty INT NOT NULL,
  unit_price_chf DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (order_id, product_id),
  CONSTRAINT fk_items_order
    FOREIGN KEY (order_id) REFERENCES orders(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_items_product
    FOREIGN KEY (product_id) REFERENCES products(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
