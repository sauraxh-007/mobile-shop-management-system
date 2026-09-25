-- ==========================================================
-- Mobile Shop Management System - Database Schema
-- ==========================================================

USE mobile_shop_db;

-- ----------------------------------------------------------
-- Users table (Admin, Sales Staff, Technician)
-- ----------------------------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'sales_staff', 'technician') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------
-- Inventory items (phones, accessories, spare parts)
-- ----------------------------------------------------------
CREATE TABLE inventory_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    brand VARCHAR(80),
    model VARCHAR(80),
    category VARCHAR(50),
    imei_serial VARCHAR(100),
    quantity INT NOT NULL DEFAULT 0,
    reorder_level INT NOT NULL DEFAULT 5,
    cost_price DECIMAL(10,2) DEFAULT 0,
    selling_price DECIMAL(10,2) NOT NULL DEFAULT 0,
    supplier VARCHAR(120),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------
-- Customers
-- ----------------------------------------------------------
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------
-- Sales (bill header)
-- ----------------------------------------------------------
CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NULL,
    staff_id INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL DEFAULT 0,
    discount DECIMAL(10,2) NOT NULL DEFAULT 0,
    tax DECIMAL(10,2) NOT NULL DEFAULT 0,
    total_amount DECIMAL(10,2) NOT NULL DEFAULT 0,
    payment_mode ENUM('cash', 'upi', 'card') NOT NULL DEFAULT 'cash',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
    FOREIGN KEY (staff_id) REFERENCES users(id)
);

-- ----------------------------------------------------------
-- Sale items (line items within a bill)
-- ----------------------------------------------------------
CREATE TABLE sale_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sale_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (sale_id) REFERENCES sales(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES inventory_items(id)
);

-- ----------------------------------------------------------
-- Repair tickets
-- ----------------------------------------------------------
CREATE TABLE repair_tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    staff_id INT NOT NULL,
    technician_id INT NULL,
    device_model VARCHAR(100) NOT NULL,
    imei VARCHAR(100),
    issue_description TEXT NOT NULL,
    status ENUM('received', 'diagnosed', 'waiting_parts', 'in_repair', 'ready', 'delivered') NOT NULL DEFAULT 'received',
    estimated_cost DECIMAL(10,2) DEFAULT 0,
    final_cost DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (staff_id) REFERENCES users(id),
    FOREIGN KEY (technician_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ----------------------------------------------------------
-- Parts used in a repair (deducted from inventory)
-- ----------------------------------------------------------
CREATE TABLE repair_parts_used (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (ticket_id) REFERENCES repair_tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES inventory_items(id)
);

-- ----------------------------------------------------------
-- Sample data (optional - for testing)
-- ----------------------------------------------------------
INSERT INTO users (name, email, password, role) VALUES
('John Doe', 'admin@shop.com', '$2y$10$examplehashreplace', 'admin');