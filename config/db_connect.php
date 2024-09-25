<?php
$host = "localhost";
$user = "root";
$password = "new_password";
$database = "real_estate_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set UTF-8 as character encoding
$conn->set_charset("utf8");
?>
