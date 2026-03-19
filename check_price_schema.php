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

$result = $conn->query("DESCRIBE price");
while ($row = $result->fetch_assoc()) {
    echo "{$row['Field']} - {$row['Type']}\n";
}

$conn->close();
?>