<?php
//including header file 
include ("header.php");


//including body file


//include footer file



?><?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .button-container button {
            background-color: #4caf50; /* Green color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>

<div class="button-container">
    <button onclick="window.location.href='add_farmuser.php'">Add User</button>
</div>

<h2>Users</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Farm</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include database connection
        include '../includes/config.php';

        // Retrieve user data from the database
        $sql = "SELECT id, username, farm FROM users";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                
                // Retrieve farm name based on farm_id
                $farm_id = $row['farm'];
                $farm_name_query = "SELECT name FROM farms WHERE id = '$farm_id'";
                $farm_name_result = mysqli_query($conn, $farm_name_query);

                // Check if farm name query result is not null
                if ($farm_name_result && mysqli_num_rows($farm_name_result) > 0) {
                    $farm_name_row = mysqli_fetch_assoc($farm_name_result);
                    $farm_name = $farm_name_row['name'];
                    echo "<td>" . $farm_name . "</td>";
                } else {
                    echo "<td>No farm found</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </tbody>
</table>

</body>
</html>
