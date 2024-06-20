

<?php
// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = md5($password); // Ideally use password_hash and password_verify
$query = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Regular user
        $_SESSION['user_type'] = 'user';
        header('Location: farm_dashboard.php');
        exit();
    }

    $error = "Invalid username or password";

}
