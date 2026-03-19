<?php
$hostname = 'localhost';
$port = '3307';
$username = 'root';
$password = '';
$database = 'himansh3_shipperrjdb';

$conn = new mysqli($hostname, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "ALTER TABLE weight_slots ADD COLUMN status VARCHAR(10) DEFAULT 'true' AFTER max_weight";

if ($conn->query($sql) === TRUE) {
    echo "Column 'status' added successfully to 'weight_slots'";
} else {
    echo "Error adding column: " . $conn->error;
}

$conn->close();
?>