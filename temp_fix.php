<?php
$conn = new mysqli("localhost", "root", "", "himansh3_shipperrjdb", 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS contact_inquiry (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    mobile VARCHAR(15) NULL,
    subject VARCHAR(255) NULL,
    message TEXT NULL,
    created_at TIMESTAMP NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table contact_inquiry created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>