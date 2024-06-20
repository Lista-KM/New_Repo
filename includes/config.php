<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "dfsms";

// Create database connection
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}