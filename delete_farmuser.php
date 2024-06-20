<?php
session_start();
require_once('includes/config.php');

// Check if admin is logged in
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Get the ID of the farm user association to delete
$fu_id = $_GET['fu_id']; // Use the correct variable name

// Delete the association from the database
$sql = "DELETE FROM farm_users WHERE id = $fu_id";

if ($conn->query($sql) === TRUE) {
    header('Location: admin_panel.php'); 
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
