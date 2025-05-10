<?php
$servername = "localhost"; // Change if your database is on a different server
$username = "root"; // Change if you have a different MySQL username
$password = ""; // Change if your MySQL has a password
$dbname = "health_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
