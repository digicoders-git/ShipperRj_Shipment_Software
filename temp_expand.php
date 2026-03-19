<?php
$conn = new mysqli("localhost", "root", "", "himansh3_shipperrjdb", 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. weight_slots
$sql1 = "CREATE TABLE IF NOT EXISTS weight_slots (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slot_name VARCHAR(255) NOT NULL,
    min_weight DECIMAL(10,2) NOT NULL,
    max_weight DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql1);

// 2. Add weight_slot_id to price
$check = $conn->query("SHOW COLUMNS FROM price LIKE 'weight_slot_id'");
if ($check->num_rows == 0) {
    $conn->query("ALTER TABLE price ADD COLUMN weight_slot_id INT(11) NULL AFTER to_pin");
}

// 3. disputes
$sql2 = "CREATE TABLE IF NOT EXISTS disputes (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    booking_id INT(11) NOT NULL,
    dispute_type VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    evidence TEXT NULL,
    status ENUM('Pending', 'Resolved') DEFAULT 'Pending',
    admin_remark TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql2);

// 4. wallet_notifications
$sql3 = "CREATE TABLE IF NOT EXISTS wallet_notifications (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    type ENUM('Credit', 'Debit') NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    reason TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql3);

echo "Database expanded successfully";
$conn->close();
?>