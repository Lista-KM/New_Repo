<?php
session_start();
require_once('includes/config.php');

// Check if admin is logged in
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Farm User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100 p-8">

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Farm User Management</h1>

        <div class="bg-white shadow rounded-lg overflow-hidden mb-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            User ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Username
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Farm ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    // Fetch farm_users data
                    $sql = "SELECT fu.user_id, fu.farm_id, u.username, f.name as farm_name, fu.id AS fu_id
                            FROM farm_users fu
                            INNER JOIN users u ON fu.user_id = u.id
                            INNER JOIN farms f ON fu.farm_id = f.id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['user_id'] . "</td>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['username'] . "</td>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['farm_name'] . "</td>"; // Added for clarity
                            echo "<td class='px-6 py-4 whitespace-nowrap'>
                                      <a href='edit_farmuser.php?id=" . $row['fu_id'] . "' class='text-blue-500 hover:text-blue-700 mr-2'>Edit</a>
                                      <a href='delete_farmuser.php?id=" . $row['fu_id'] . "' class='text-red-500 hover:text-red-700' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='px-6 py-4 whitespace-nowrap'>No farm users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h2>Add Farm User</h2>
            <form method="POST" action="add_farmuser.php">
                </form>
        </div>
    </div>

</body>

</html>
