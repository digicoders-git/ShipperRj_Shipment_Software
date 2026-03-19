<?php
define('BASEPATH', 'foo');
require_once 'application/config/database.php';
$db_config = $db['default'];

$conn = new mysqli($db_config['hostname'], $db_config['username'], $db_config['password'], $db_config['database']);

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