<?php
//including header file 
include ("../header.php");


//including body file


//include footer file



?><!DOCTYPE html>
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

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 500px;
            padding: 20px;
            background: #2C478D;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #FFFFFF;
            z-index: 1000;
        }

        .popup .title {
            font-weight: 800;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .popup .label {
            font-weight: 800;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .popup select,
        .popup input[type="date"],
        .popup input[type="number"] {
            width: calc(100% - 20px);
            height: 40px;
            background: #D9D9D9;
            border: none;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .popup select {
            color: #000;
        }

        .popup input[type="number"]::placeholder {
            color: #888888;
        }

        .popup .button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #2C478D;
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .popup .button:hover {
            background: #3b5baf;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

    </style>
    <title>Milk Collection</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Milk Collection</h1>
        </div>
        <div class="button-container">
            <!-- Set onclick attribute to redirect to add_milk.php -->
            <button onclick="location.href='../user/add_milk.php'">+ New Record</button>
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
    GROUP BY mr.date, c.name
    ORDER BY mr.date DESC, c.name ASC";
 

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
</body>
</html>