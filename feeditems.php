<?php
// Database connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dfsms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from feed_items table
$sql = "SELECT * FROM feed_items";
$result = $conn->query($sql);

// Array to hold fetched data
$feedItems = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $feedItems[] = $row;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Items Table</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>

<body>
    <div class="p-4">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-zinc-200 text-zinc-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Unit</th>
                    <th class="py-3 px-6 text-left">Unit Price</th>
                    <th class="py-3 px-6 text-left">Available Stock</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedItems as $item) : ?>
                    <tr>
                        <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($item['item_name']); ?></td>
                        <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($item['unit_of_measure']); ?></td>
                        <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($item['unit_price']); ?></td>
                        <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($item['available_stock']); ?></td>
                        <td class="py-3 px-6 text-left">
                            <!-- Actions: Edit and Delete buttons (you can customize these actions) -->
                            <button>Edit</button>
                            <button>Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
