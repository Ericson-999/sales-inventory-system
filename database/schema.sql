CREATE DATABASE sales_inventory;
USE sales_inventory;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  user_type VARCHAR(20) NOT Null
);

INSERT INTO users (name, username, password, user_type)
VALUES (
  'Administrator',
  'admin',
  '$2y$12$B0RuKbra/h4J8GCLuwGMK.2dFAOsNSAUYngb02.GUQEJYGagUIcMS',
  'admin'
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sku VARCHAR(50) NOT NULL,
  category VARCHAR(50) NOT NULL,
  product_name VARCHAR(100) NOT NULL,
  description VARCHAR(50) NOT NULL,
  product_price DECIMAL(10,2) NOT NULL
);

CREATE TABLE supplier (
  id INT AUTO_INCREMENT PRIMARY KEY,
  supplier_name varchar(50) NOT NULL,
  contact varchar(15) NOT NULL,
  address varchar(100) NOT NULL
)