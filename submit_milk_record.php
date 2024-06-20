<?php
include 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cowId = $_POST['cow_id'];
    $date = $_POST['date'];
    $session = $_POST['session'];
    $milkQuantity = $_POST['milk_quantity'];

    $insertQuery = "INSERT INTO milk_records (cow_id, date, session, milk_quantity) 
                    VALUES ('$cowId', '$date', '$session', '$milkQuantity')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "Milk record added successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

$conn->close(); 
?>
