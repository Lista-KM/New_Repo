<?php
//including header file 
include ("header.php");


//including body file


//include footer file



?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farms</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Farms</h2>
            <button onclick="window.location.href='add_farms.php'" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">+ Add Farm</button>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    // Include database connection
                    include '../includes/config.php';

                    // Retrieve farm data from the database
                    $sql = "SELECT * FROM farms";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['id'] . "</td>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['name'] . "</td>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['location'] . "</td>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['size'] . "</td>";
                            echo "<td class='px-6 py-4 whitespace-nowrap'>
                                    <button class='bg-yellow-500 text-white px-4 py-2 rounded-lg' onclick=\"window.location.href='farm_dashboard.php?id=" . $row['id'] . "'\">View Details</button> 
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='px-6 py-4 whitespace-nowrap'>No farms found</td></tr>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
