<?php
include 'includes/config.php'; // Ensure this file includes the $conn database connection

// Fetch total cow count
$totalCowsQuery = "SELECT COUNT(*) as total_cows FROM cows";
$totalCowsResult = $conn->query($totalCowsQuery);
$totalCowsData = $totalCowsResult->fetch_assoc();
$totalCows = $totalCowsData['total_cows'];

// Fetch total milk liters for today
$totalMilkQuery = "SELECT SUM(total) AS total_milk FROM milk_records WHERE date = CURDATE()";
$totalMilkResult = $conn->query($totalMilkQuery);
$totalMilkData = $totalMilkResult->fetch_assoc();
$totalMilk = $totalMilkData['total_milk'] ?? 0;

// Debugging: Check the value of $totalMilk

// Fetch total farm count
$totalFarmsQuery = "SELECT COUNT(*) as total_farms FROM farms";
$totalFarmsResult = $conn->query($totalFarmsQuery);
$totalFarmsData = $totalFarmsResult->fetch_assoc();
$totalFarms = $totalFarmsData['total_farms'];

// Fetch total yields for today
$currentDate = date('Y-m-d');
$milkQuery = "
    SELECT SUM(mr.morning + mr.noon + mr.evening) AS total_yields
    FROM milk_records mr
    WHERE mr.date = '$currentDate'";
$milkResult = $conn->query($milkQuery);
$milkData = $milkResult->fetch_assoc();
$totalYields = $milkData['total_yields'] ?? 0;
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
        /* Style for the sidebar */
        .sidebar {
            display: none; /* Initially hide the sidebar */
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 240px;
            background-color: #333;
            color: grey;
            padding-top: 3.5rem;
            z-index: 1000;
        }

        .sidebar ul {
            padding: 0;
            list-style-type: none;
        }

        .sidebar li {
            padding: 0.5rem; /* Adjusted padding */
        }

        .sidebar a {
            display: block;
            padding: 0.5rem;
            color: #fff;
            text-decoration: none;
            border-radius: 0.25rem; /* Added border radius */
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #555; /* Hover color */
        }

        /* Style for the main content area */
        .main-content {
            margin-left: 240px; /* Same width as the sidebar */
        }

        /* Style for the sidebar toggle button */
        .sidebar-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001; /* Ensure it's above the sidebar */
            background-color: #333;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
        .milk-table {
            width: 100%;
            margin-top: 20px; /* Adjust this margin as needed */
            border-collapse: collapse;
            background: #FFFFFF;
            table-layout: fixed;
        }
        .milk-table th, .milk-table td {
            border: 1px solid #CCCCCC;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }
        .milk-table th {
            background: #2C478D;
            color: #FFFFFF;
        }
        .milk-table td .text-zinc-500 {
            color: #999999;
        }
        .milk-table td .text-green-500 {
            color: #00FF00;
        }
        .milk-table td .text-red-500 {
            color: #FF0000;
        }
        .summary {
            background: #2C478D;
            color: #FFFFFF;
            padding: 20px;
            margin-top: 30px;
            border-radius: 15px;
        }
        .summary h2 {
            font-weight: 800;
            font-size: 1.5rem;
            margin: 0 0 10px 0;
        }
        .summary p {
            font-size: 1rem;
            margin: 4px 0;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="sidebar" id="sidebar">
    <ul>
        <li><a href="farm_dashboard.php">Dashboard</a></li>
        <li><a href="cows.php">Cow Records</a></li>
        <li><a href="milk.php">Milk Production</a></li>
        <li><a href="users.php">User Management</a></li>
        <li><a href="#">Feed Management</a></li>
        <li><a href="#">Animal Health</a></li>
        <li><a href="#">Farm Expenses</a></li>
        <li><a href="#">Breeding</a></li>
    </ul>
</div>

<div class="main-content">
    <button class="sidebar-toggle" id="sidebar-toggle"><i class="fas fa-bars"></i></button>

    <!-- Main content goes here -->
    <div class="bg-white p-8 rounded-lg shadow-md mb-8 mt-8">
        <h2 class="your-title-class">What's Going on today😊...</h2> 
    </div>

    <div class="flex flex-wrap -mx-4 mb-8">
        <!-- Total Farms Block -->
        <div class="w-full md:w-1/3 px-4">
            <div class="bg-white p-8 rounded-lg shadow-md h-full">
                <h2 class="text-lg font-semibold mb-4">Total Farms</h2>
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-gray-600">No of farms</p>
                        <p class="text-4xl font-bold text-blue-500">
                            <?php echo $totalFarms; ?>
                        </p>
                    </div>
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='farms.php'">View Details</button>
                </div>
            </div>
        </div>

        <!-- Total Cows Block -->
        <div class="w-full md:w-1/3 px-4">
            <div class="bg-white p-8 rounded-lg shadow-md h-full">
                <h2 class="text-lg font-semibold mb-4">Total Cows</h2>
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-gray-600">Total Cows</p>
                        <p class="text-4xl font-bold text-blue-500">
                            <?php echo $totalCows; ?>
                        </p>
                    </div>
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='cows.php'">View Details</button>
                </div>
            </div>
        </div>

        <!-- Milk Production Block -->
        <div class="w-full md:w-1/3 px-4">
            <div class="bg-white p-8 rounded-lg shadow-md h-full">
                <h2 class="text-lg font-semibold mb-4">Milk Production</h2>
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-gray-600">Total Litres</p>
                        <p class="text-4xl font-bold text-blue-500">
                            <?php echo $totalMilk; ?>
                        </p>
                    </div>
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='milk.php'">View Details</button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="milk-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Morning</th>
                    <th>Noon</th>
                    <th>Evening</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include("includes/config.php");

                $currentDate = date('Y-m-d');

                // SQL query with deviation calculations for the current date
                $milkQuery = "
                SELECT mr.date, c.name, 
                       SUM(mr.morning) AS morning, 
                       SUM(mr.noon) AS noon, 
                       SUM(mr.evening) AS evening,
                       SUM(mr.morning + mr.noon + mr.evening) AS total,
                       COALESCE(SUM(mr.morning) - (
                           SELECT SUM(morning) 
                           FROM milk_records mr2 
                           WHERE mr2.name = mr.name AND mr2.date = DATE_SUB(mr.date, INTERVAL 1 DAY)
                           GROUP BY mr2.name
                       ), 0) AS morning_dev,
                       COALESCE(SUM(mr.noon) - (
                           SELECT SUM(noon) 
                           FROM milk_records mr2 
                           WHERE mr2.name = mr.name AND mr2.date = DATE_SUB(mr.date, INTERVAL 1 DAY)
                           GROUP BY mr2.name
                       ), 0) AS noon_dev,
                       COALESCE(SUM(mr.evening) - (
                           SELECT SUM(evening) 
                           FROM milk_records mr2 
                           WHERE mr2.name = mr.name AND mr2.date = DATE_SUB(mr.date, INTERVAL 1 DAY)
                           GROUP BY mr2.name
                       ), 0) AS evening_dev,
                       COALESCE((SUM(mr.morning + mr.noon + mr.evening)) - (
                           SELECT SUM(morning + noon + evening) 
                           FROM milk_records mr2 
                           WHERE mr2.name = mr.name AND mr2.date = DATE_SUB(mr.date, INTERVAL 1 DAY)
                           GROUP BY mr2.name
                       ), 0) AS total_dev
                FROM milk_records mr 
                JOIN cows c ON mr.name = c.id
                WHERE mr.date = '$currentDate'
                GROUP BY mr.date, c.name
                ORDER BY c.name ASC"; 

                $milkResult = $conn->query($milkQuery);

                $dailySummary = [
                    'total' => 0,
                    'count' => 0,
                    'yields' => []
                ];

                while ($record = $milkResult->fetch_assoc()) {
                    $date = $record['date'];
                    $name = $record['name'];
                    $morning = $record['morning'];
                    $noon = $record['noon'];
                    $evening = $record['evening'];
                    $total = $record['total'];
                    $morning_dev = $record['morning_dev'];
                    $noon_dev = $record['noon_dev'];
                    $evening_dev = $record['evening_dev'];
                    $total_dev = $record['total_dev'];

                    $dailySummary['total'] += $total;
                    $dailySummary['count'] += 1;
                    $dailySummary['yields'][] = $total;

                    echo "<tr>";
                    echo "<td>$date</td>";
                    echo "<td>$name</td>";
                    echo "<td>$morning <span class='" . (($morning_dev >= 0) ? 'text-green-500' : 'text-red-500') . "'>" . (($morning_dev >= 0) ? '+' : '') . "$morning_dev</span></td>";
                    echo "<td>$noon <span class='" . (($noon_dev >= 0) ? 'text-green-500' : 'text-red-500') . "'>" . (($noon_dev >= 0) ? '+' : '') . "$noon_dev</span></td>";
                    echo "<td>$evening <span class='" . (($evening_dev >= 0) ? 'text-green-500' : 'text-red-500') . "'>" . (($evening_dev >= 0) ? '+' : '') . "$evening_dev</span></td>";
                    echo "<td>$total <span class='" . (($total_dev >= 0) ? 'text-green-500' : 'text-red-500') . "'>" . (($total_dev >= 0) ? '+' : '') . "$total_dev</span></td>";
                    echo "</tr>";
                    }
            // Calculate summary data
            $totalYields = array_sum($dailySummary['yields']);
            $numberOfCows = $dailySummary['count'];
            $lowestYield = min($dailySummary['yields']);
            $highestYield = max($dailySummary['yields']);
            $averageYield = $totalYields / $numberOfCows;

            ?>
            </tbody>
        </table>
    </div>
    <div class="summary">
        <h2>Daily Summary for <?php echo $currentDate; ?></h2>
        <p>Total Yields: <?php echo $totalYields; ?></p>
        <p>No of Cows: <?php echo $numberOfCows; ?></p>
        <p>Lowest Yield: <?php echo $lowestYield; ?></p>
        <p>Highest Yield: <?php echo $highestYield; ?></p>
        <p>Average Yield: <?php echo number_format($averageYield, 2); ?></p>
    </div>
</div>

<script>
    // Function to toggle the sidebar visibility
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.style.display = sidebar.style.display === 'none' ? 'block' : 'none';
    });
</script>

</body>
</html>

