<?php
session_start();

// Database connection parameters (Replace with your actual credentials)
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "dfsms";

// Establish database connection
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']); // Get the password from the form

    // Check if the username exists in the 'users' table
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_type'] = 'user';
            $_SESSION['username'] = $username; // Store the username in the session
            header('Location: farm_dashboard.php'); // Redirect to the user dashboard
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        // If user not found in 'users', check in 'tbladmin'
        $query = "SELECT * FROM tbladmin WHERE UserName='$username'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $admin = mysqli_fetch_assoc($result);
            // Verify the password
            if (password_verify($password, $admin['Password'])) {
                $_SESSION['user_type'] = 'admin';
                $_SESSION['username'] = $username; // Store the username in the session
                header('Location: dashboard.php'); // Redirect to the admin dashboard
                exit();
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
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
        input[type="password"] {
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
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>

</html>
