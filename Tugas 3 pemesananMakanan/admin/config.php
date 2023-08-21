<?php
$server="localhost";
$username="admin";
$password="123";
$database = "id19764860_kuenida";
// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
