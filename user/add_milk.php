<?php
// Include your database connection file
include '../includes/config.php';
$conn = new mysqli("localhost", "root", "", "dfsms");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Adjust the variable names to match your form field names
    $cowId = $conn->real_escape_string($_POST['cow_id']);
    $date = $_POST['date'];
    $session = $conn->real_escape_string($_POST['session']);
    $milkQuantity = $conn->real_escape_string($_POST['milk_quantity']);

    // Modify the SQL query to match your table structure
    $sql = "INSERT INTO milk_records (name, date, $session) 
            VALUES ('$cowId', '$date', '$milkQuantity')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Milk Record Popup</title>

    <style>
             body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: rgba(0, 0, 0, 0.5); /* Darken background to highlight popup */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .popup {
            position: relative;
            width: 80%;
            max-width: 500px;
            padding: 20px;
            background: #2C478D;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #FFFFFF;
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

        .popup input[type="text"],
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

        .popup input[type="text"]::placeholder,
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
    </style>
</head>
<body>
    <div class="popup">
        <div class="title">Add Milk Record</div>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <div class="label">Select Cow:</div>
            <select name="cow_id">
                <?php
                // Fetch cows from the database
                $cowQuery = "SELECT id, name FROM cows"; 
                $cowResult = $conn->query($cowQuery);

                while ($cow = $cowResult->fetch_assoc()) {
                    echo "<option value='" . $cow['id'] . "'>" . $cow['name'] . "</option>";
                }
                ?>
            </select>
            
            <div class="label">Date:</div>
            <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
            
            <div class="label">Session:</div>
            <select name="session">
                <option value="Morning">Morning</option>
                <option value="Noon">Noon</option>
                <option value="Evening">Evening</option>
            </select>
            
            <div class="label">Milk:</div>
            <input type="number" name="milk_quantity" placeholder="Enter milk quantity (in liters)">
            
            <button class="button" type="submit">Submit</button>
        </form> 
    </div>
</body>
</html>
