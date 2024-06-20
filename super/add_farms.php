<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Farm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
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
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Farm</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
        <label for="size">Size:</label>
        <input type="text" id="size" name="size" required>
        <button type="submit">Add Farmer</button>
    </form>
</div>

<?php
// Include database connection
include '../includes/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the SQL statement
    $sql = "INSERT INTO farms (id, name, location, size) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $id, $name, $location, $size);

    // Set parameters and execute the statement
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $size = $_POST['size'];
    $stmt->execute();

    // Check if the statement was executed successfully
    if ($stmt->affected_rows > 0) {
        echo "<p>New farm added successfully</p>";
    } else {
        echo "<p>Error adding farm: " . $stmt->error . "</p>";
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>


</body>
</html>
