<?php
$conn = new mysqli('localhost', 'root', '', '');
if ($conn->connect_error) die('Connection failed: ' . $conn->connect_error);

$conn->query("CREATE DATABASE IF NOT EXISTS patient_record CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$conn->select_db('patient_record');

$conn->query("
CREATE TABLE IF NOT EXISTS patient_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    unique_id VARCHAR(10) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    visit_number INT NOT NULL DEFAULT 1,
    name VARCHAR(255) NOT NULL,
    parentage VARCHAR(255) DEFAULT '',
    age TINYINT UNSIGNED DEFAULT NULL,
    gender ENUM('Male','Female','Other') DEFAULT NULL,
    weight DECIMAL(5,2) DEFAULT NULL,
    phone VARCHAR(30) DEFAULT '',
    address TEXT DEFAULT NULL,
    allergy TEXT DEFAULT NULL,
    symptoms TEXT DEFAULT NULL,
    findings TEXT DEFAULT NULL,
    treatment TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_unique_id (unique_id),
    INDEX idx_date (date),
    INDEX idx_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

echo "Database and table created successfully.";
$conn->close();
