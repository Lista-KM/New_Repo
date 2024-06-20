<?php
session_start(); 
include '../includes/config.php';

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Assume user_id is stored in the session
$user_id = $_SESSION['user_id'];

// Fetch user and farm details
$userQuery = "SELECT users.username AS user_name, farms.name AS farm_name 
              FROM users 
              JOIN farms ON users.farm = farms.id 
              WHERE users.id = ?";

$stmt = $conn->prepare($userQuery);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    if ($userData) {
        $userName = $userData['user_name'];
        $farmName = $userData['farm_name'];
        // Customized message based on user and farm
        $message = "Welcome to $farmName, $userName!";
    } else {
        // Handle case where user data is not found
        $userName = "Unknown";
        $farmName = "Unknown Farm";
        $message = "Welcome, $userName! We couldn't determine your farm association.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle error if the statement couldn't be prepared
    $userName = "Unknown";
    $farmName = "Unknown Farm";
    $message = "Error preparing the SQL statement.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidebar {
            width: 0;
            position: fixed;
            z-index: 1;
            height: 100%;
            top: 0;
            left: 0;
            background-color: #2C478D;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: whitesmoke;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
        }

        .openbtn {
            font-size: 25px;
            cursor: pointer;
            background-color: #173677;
            color: white;
            padding: 10px 15px;
            border: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 2;
        }

        .openbtn:hover {
            background-color: #173677;
        }

        .txtnav {
            background-color: #173677;
            margin-bottom: 10px;
            border-radius: 25px;
            margin-left: 10px;
            margin-right: 20px;
            font-weight: bold;
            font-size: 15px;
        }

        .txtnav:hover {
            background-color: #455e92;
        }

        .txt20 {
            color: whitesmoke;
            font-weight: bolder;
            padding: 15px;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .textdexo {
            color: whitesmoke;
            font-weight: bolder;
            position: absolute;
        }

        .main-content {
            padding-left: 250px;
            transition: 0.5s;
            padding-top: 70px; /* Adjust to make space for the button */
        }
    </style>
</head>

<body>

<div class="sidebar" id="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <ul>
        <li><a href="farm_dashboard.php">Dashboard</a></li>
        <li><a href="cows.php">Cow Records</a></li>
        <li><a href="milk.php">Milk Production</a></li>
        <li><a href="users.php">User Management</a></li>
        <li><a href="feeds.php">Feed Management</a></li>
        <li><a href="#">Animal Health</a></li>
        <li><a href="#">Farm Expenses</a></li>
        <li><a href="#">Breeding</a></li>
    </ul>
</div>
<div class="main-content">
    <div class="navbtn">
        <button class="openbtn" onclick="openNav()">☰</button>
        <div class="textdexo"></div>
        <div class="txt20">
        <form method="post" action="index.php">
                <button class="txtnav" type="submit" style="color:whitesmoke;" name="logout">Logout</button>
            </form>
        </div>
    </div>
</div>


    <!-- Other main content -->

</div>

<button class="openbtn" onclick="openNav()">☰</button>

<script>
    function openNav() {
        document.getElementById("sidebar").style.width = "250px";
        document.querySelector('.main-content').style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("sidebar").style.width = "0";
        document.querySelector('.main-content').style.marginLeft = "0";
    }
</script>

</body>
</html>
