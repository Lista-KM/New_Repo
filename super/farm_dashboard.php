<?php
//including header file 
include ("../head.php");


//including body file


//include footer file



?><?php
session_start();
include '../includes/config.php';

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Assume user_id is stored in the session
$user_id = $_SESSION['user_id'];

$farm_id = isset($_GET['farm_id']) ? intval($_GET['farm_id']) : 0;

// Fetch user and farm details
$userQuery = "SELECT users.username AS user_name, farms.name AS farm_name 
              FROM users 
              LEFT JOIN farms ON users.farm = farms.id 
              WHERE users.id = ?";

$stmt = $conn->prepare($userQuery);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    if ($userData) {
        $userName = $userData['user_name'];
        $farmName = $userData['farm_name'];
        if ($farmName && !empty($farmName)) {
            // Customized message based on user and farm
            $message = "Welcome to $farmName, $userName!";
        } else {
            // Handle case where user is not associated with any farm
            $message = "Welcome, $userName! You are not associated with any farm.";
        }
    } else {
        // Handle case where user data is not found
        $userName = "Unknown";
        $farmName = "Unknown Farm";
        $message = "Welcome to $farmName, $userName! We couldn't determine your farm association.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle error if the statement couldn't be prepared
    $userName = "Unknown";
    $farmName = "Unknown Farm";
    $message = "Error preparing the SQL statement.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>

</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <style>
        .sidebar {
            display: none;
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
            padding: 0.5rem;
        }
        .sidebar a {
            display: block;
            padding: 0.5rem;
            color: #fff;
            text-decoration: none;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #555;
        }
        .main-content {
            margin-left: 240px;
        }
        .sidebar-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background-color: #333;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
    </style>
</head>




    <!-- Personalized Welcome Message -->
    <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md mb-4 mt-4">
        <h1 class="text-2xl font-bold">Welcome to <?php echo htmlspecialchars($farmName); ?>, <?php echo htmlspecialchars($userName); ?>!</h1>
    </div>

    <!-- Main content goes here -->
    <?php
    include '../includes/config.php';  

    // Fetch cow count
    $totalCowsQuery = "SELECT COUNT(*) as total_cows FROM cows";
    $totalCowsResult = $conn->query($totalCowsQuery);
    $totalCowsData = $totalCowsResult->fetch_assoc();
    $totalCows = $totalCowsData['total_cows'];

    // Fetch total milk liters for today 
    $totalMilkQuery = "SELECT SUM(total) AS total_milk FROM milk_records WHERE date = CURDATE()";
    $totalMilkResult = $conn->query($totalMilkQuery);
    $totalMilkData = $totalMilkResult->fetch_assoc();
    $totalMilk = $totalMilkData['total_milk'] ?? 0; 

    function get_total_milk(){
        include 'includes/config.php';
        $totalMilkQuery = "SELECT SUM(total) AS total_milk FROM milk_records WHERE date = CURDATE()";
        $totalMilkResult = $conn->query($totalMilkQuery);
        $totalMilkData = $totalMilkResult->fetch_assoc();
        $totalMilk = $totalMilkData['total_milk'] ?? 0;
        return $totalMilk;
    }
    
    function get_total_cows(){
        include 'includes/config.php';
        $totalCowsQuery = "SELECT COUNT(*) as total_cows FROM cows";
        $totalCowsResult = $conn->query($totalCowsQuery);
        $totalCowsData = $totalCowsResult->fetch_assoc();
        $totalCows = $totalCowsData['total_cows']; 
        return $totalCows;
    }
    ?>

<div class="flex flex-wrap -mx-4 mb-8">
    <div class="w-full md:w-1/3 px-4"> 
        <div class="bg-white p-8 rounded-lg shadow-md h-full">
            <h2 class="text-lg font-semibold mb-4">Total Workers</h2>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-gray-600">no of farmworkers</p>
                    <p class="text-4xl font-bold text-blue-500">1</p>
                </div>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='farms.php'">View Details</button>
            </div>
            </div>
    <!-- Additional Farm Details Here -->
</div>

<!-- Total Cows Block -->
    <div class="w-full md:w-1/3 px-4"> 
        <div class="bg-white p-8 rounded-lg shadow-md h-full">
            <h2 class="text-lg font-semibold mb-4">Total Cows</h2>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-gray-600">Total Cows</p>
                    <p class="text-4xl font-bold text-blue-500">1</p>
                </div>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='Cows.php'">View Details</button>
            </div>
            </div>
    </div>
    <div class="w-full md:w-1/3 px-4">
        <div class="bg-white p-8 rounded-lg shadow-md h-full">
            <h2 class="text-lg font-semibold mb-4">Milk Production</h2>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-gray-600">Total Litres</p>
                    <p class="text-4xl font-bold text-blue-500">0</p>
                </div>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='milk.php'">View Details</button>
            </div>
            </div>
    </div>



<script>
// Function to toggle the sidebar visibility
document.getElementById('sidebar-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    sidebar.style.display = sidebar.style.display === 'none' ? 'block' : 'none';
});

// Function to fetch and display data
function fetchData() {
    fetch('milk.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total_milk').textContent = data.total_milk + ' Lts';
        });

    fetch('cows.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total_cows').textContent = data.total_cows;
        });

    fetch('users.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total_users').textContent = data.total_users;
        });
}

// Fetch data when the page loads and periodically refresh every 5 minutes
document.addEventListener('DOMContentLoaded', function() {
    fetchData();
    // Refresh data every 5 minutes (300,000 milliseconds)
    setInterval(fetchData, 300000);
});

window.onload = fetchData;
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #FFFFFF; 
            padding: 20px; 
            box-sizing: border-box; 
        }

        .header {
            background: none; 
            color: #000000; 
            text-align: center;
            padding: 20px; 
        }

        .header h1 {
            font-weight: 800;
            font-size: 2rem; 
            line-height: 1.3;
            margin: 0;
            color: #000000;
        }

        .button-container {
            text-align: right;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .button-container button {
            background: #2C478D;
            color: #FFFFFF;
            font-weight: 700;
            font-size: 1rem; 
            line-height: 1.3;
            padding: 10px 20px; 
            border: none;
            border-radius: 5px; 
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #FFFFFF;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #CCCCCC;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background: #2C478D;
            color: #FFFFFF;
        }

        td .text-zinc-500 {
            color: #999999;
        }

        td .text-green-500 {
            color: #00FF00;
        }

        td .text-red-500 {
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
    <title>Milk Collection</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Milk Records</h1>
        </div>
        
        <div class="table-container">
            <table>
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
                include("../includes/config.php");

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
            $lowestYield = !empty($dailySummary['yields']) ? min($dailySummary['yields']) : 0;
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
</body>
</html>
