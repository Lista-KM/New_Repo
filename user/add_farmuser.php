<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection parameters
$db_host = "localhost"; // Change this to your database host if different
$db_user = "root";
$db_pass = "";
$db_name = "dfsms";

// Attempt to establish a connection to the database
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $farm_id = $_POST['farm_id'];
    $role = $_POST['role'];

    // Insert the new user into the 'users' table
    $query = "INSERT INTO users (username, password, farm, role) VALUES ('$username', '$password', '$farm_id', '$role')";
    if (mysqli_query($con, $query)) {
        $success = "User added successfully!";
    } else {
        $error = "Error adding user: " . mysqli_error($con);
    }
}

// Retrieve all farms to populate the dropdown
$farm_query = "SELECT * FROM farms";
$farm_result = mysqli_query($con, $farm_query);
$farms = mysqli_fetch_all($farm_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Farm User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .add-user-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="add-user-container">
        <h1>Add Farm User</h1>
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (isset($success)) : ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="farm_id">Farm:</label>
            <select id="farm_id" name="farm_id" >
                <option value="">None</option> <!-- Option for None -->
                <?php foreach ($farms as $farm) : ?>
                    <option value="<?php echo $farm['id']; ?>"><?php echo $farm['name']; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Superadmin">Superadmin</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select><br><br>
            <button type="submit" name="add_user">Add User</button>
        </form>
    </div>
</body>

</html>
