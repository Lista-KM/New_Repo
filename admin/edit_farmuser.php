<?php
session_start();
require_once('includes/config.php');

// Check if admin is logged in
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Get the ID of the farm user association to edit
$fu_id = $_GET['fu_id']; // Use the correct variable name

// Fetch existing data
$sql = "SELECT fu.user_id, u.username, fu.farm_id, f.name as farm_name
        FROM farm_users fu
        INNER JOIN users u ON fu.user_id = u.id
        INNER JOIN farms f ON fu.farm_id = f.id
        WHERE fu.id = $fu_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
    $username = $row['username'];
    $farm_id = $row['farm_id'];
    $farm_name = $row['farm_name'];
} else {
    echo "Farm user association not found";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated data
    $new_farm_id = $_POST['farm_id'];

    // Update the database
    $sql = "UPDATE farm_users SET farm_id = '$new_farm_id' WHERE id = $fu_id"; // Use the correct variable name

    if ($conn->query($sql) === TRUE) {
        header('Location: admin_panel.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
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
</head>

<body class="bg-gray-100 p-8">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Farm User</h1>
        <div class="bg-white shadow rounded-lg p-4">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?fu_id='.$fu_id; ?>"> 
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" disabled><br><br>

                <label for="farm_id">Farm:</label>
                <select id="farm_id" name="farm_id" required>
                    <?php foreach ($farms as $farm) : ?>
                        <option value="<?php echo $farm['id']; ?>" <?php if ($farm['id'] == $farm_id) echo 'selected'; ?>><?php echo $farm['name']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
