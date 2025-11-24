CREATE DATABASE sales_inventory;
USE sales_inventory;

-- Users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  user_type VARCHAR(20) NOT NULL
);

-- Default admin account
INSERT INTO users (name, username, password, user_type)
VALUES (
  'Administrator',
  'admin',
  '$2y$12$B0RuKbra/h4J8GCLuwGMK.2dFAOsNSAUYngb02.GUQEJYGagUIcMS',
  'admin'
);

-- Products (global catalog)
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sku VARCHAR(50) NOT NULL,
  category VARCHAR(50) NOT NULL,
  product_name VARCHAR(100) NOT NULL,
  description VARCHAR(50) NOT NULL,
  product_price DECIMAL(10,2) NOT NULL
);

-- Suppliers
CREATE TABLE supplier (
  id INT AUTO_INCREMENT PRIMARY KEY,
  supplier_name VARCHAR(50) NOT NULL,
  contact VARCHAR(15) NOT NULL,
  address VARCHAR(100) NOT NULL
);

-- Customers
CREATE TABLE customer (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  contact VARCHAR(20),
  address VARCHAR(70)
);

-- Categories
CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(100) NOT NULL UNIQUE
);

-- Sales
CREATE TABLE sales (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reference_number VARCHAR(50) NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  amount DECIMAL(10,2) GENERATED ALWAYS AS (quantity * price) STORED,
  customer_id INT DEFAULT NULL,
  staff_id INT NOT NULL,
  date DATETIME DEFAULT CURRENT_TIMESTAMP,
  payment_method VARCHAR(30) DEFAULT 'Cash',
  remarks TEXT,
  
  FOREIGN KEY (product_id) REFERENCES products(id),
  FOREIGN KEY (customer_id) REFERENCES customer(id),
  FOREIGN KEY (staff_id) REFERENCES users(id)
);

-- Receiving (header)
CREATE TABLE receiving (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reference_number VARCHAR(50) NOT NULL UNIQUE,
  supplier_id INT NOT NULL,
  staff_id INT NOT NULL,
  date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (supplier_id) REFERENCES supplier(id),
  FOREIGN KEY (staff_id) REFERENCES users(id)
);

-- Receiving Items (details)
CREATE TABLE receiving_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  receiving_id INT NOT NULL,
  product_id INT NOT NULL,
  qty INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  amount DECIMAL(10,2) GENERATED ALWAYS AS (qty * price) STORED,
  FOREIGN KEY (receiving_id) REFERENCES receiving(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
);

-- ✅ Receiving-specific product list (separate from global products)
CREATE TABLE receiving_products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(100) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
