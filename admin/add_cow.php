<?php
require_once('../includes/config.php'); 

// Handle Add Cow (POST Request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $ksb_no = mysqli_real_escape_string($conn, $_POST['ksb_no']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $breed = mysqli_real_escape_string($conn, $_POST['breed']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $farm = mysqli_real_escape_string($conn, $_POST['farm']);
    $group = mysqli_real_escape_string($conn, $_POST['group']);
    $lactations = mysqli_real_escape_string($conn, $_POST['lactations']);
    $current_weight = mysqli_real_escape_string($conn, $_POST['current_weight']);
    $current_yield = mysqli_real_escape_string($conn, $_POST['current_yield']);
    $sire = mysqli_real_escape_string($conn, $_POST['sire']);
    $grand_sire = mysqli_real_escape_string($conn, $_POST['grand_sire']);
    $dam = mysqli_real_escape_string($conn, $_POST['dam']);
    $grand_dam = mysqli_real_escape_string($conn, $_POST['grand_dam']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $birth_weight = mysqli_real_escape_string($conn, $_POST['birth_weight']);
    $source = mysqli_real_escape_string($conn, $_POST['source']);
    $date_purchased = mysqli_real_escape_string($conn, $_POST['date_purchased']);
  

    // Prepare and execute the SQL statement to insert data
    $sql = "INSERT INTO cows (code, name, ksb_no, grade, breed, color, category, farm, `group`, lactations, current_weight, current_yield, sire, grand_sire, dam, grand_dam, date_of_birth, birth_weight, source, date_purchased)
            VALUES ('$code', '$name', '$ksb_no', '$grade', '$breed', '$color', '$category', '$farm', '$group', '$lactations', '$current_weight', '$current_yield', '$sire', '$grand_sire', '$dam', '$grand_dam', '$date_of_birth', '$birth_weight', '$source', '$date_purchased')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Optional: Redirect or update the cow list on the current page
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
    <title>Register Cow</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .fixed {
            position: fixed;
        }

        .inset-0 {
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .bg-black {
            background-color: black;
        }

        .bg-opacity-50 {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .bg-white {
            background-color: white;
        }

        .p-8 {
            padding: 2rem;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .w-1/2 {
            width: 50%;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .font-bold {
            font-weight: bold;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .grid {
            display: grid;
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .gap-4 {
            gap: 1rem;
        }

        .border {
            border: 1px solid #ccc;
        }

        .rounded {
            border-radius: 0.25rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .bg-yellow-500 {
            background-color: #ecc94b;
        }

        .text-white {
            color: white;
        }

        .ml-4 {
            margin-left: 1rem;
        }

        .overflow-y-auto {
            overflow-y: auto;
        }

        .max-h-screen {
            max-height: 100vh;
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div id="newRecordModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-lg w-1/2 overflow-y-auto max-h-screen">
            <h2 class="text-lg font-bold mb-4">New Cow Record</h2>
            <form id="newRecordForm" action="cows.php" method="POST">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input type="text" name="code" placeholder="Code" class="border rounded p-2" required>
                    <input type="text" name="name" placeholder="Name" class="border rounded p-2" required>
                    <input type="text" name="ksb_no" placeholder="KSB No" class="border rounded p-2" required>
                    <input type="text" name="grade" placeholder="Grade" class="border rounded p-2" required>
                    <input type="text" name="breed" placeholder="Breed" class="border rounded p-2" required>
                    <input type="text" name="color" placeholder="Color" class="border rounded p-2" required>
                    <input type="text" name="category" placeholder="Category" class="border rounded p-2" required>
                    <input type="text" name="farm" placeholder="Farm" class="border rounded p-2" required>
                    <input type="text" name="group" placeholder="Group" class="border rounded p-2" required>
                    <input type="text" name="lactations" placeholder="Lactations" class="border rounded p-2" required>
                    <input type="text" name="current_weight" placeholder="Current Weight" class="border rounded p-2" required>
                    <input type="text" name="current_yield" placeholder="Current Yield" class="border rounded p-2" required>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input type="text" name="sire" placeholder="Sire" class="border rounded p-2" required>
                    <input type="text" name="grand_sire" placeholder="Grand Sire" class="border rounded p-2" required>
                    <input type="text" name="dam" placeholder="Dam" class="border rounded p-2" required>
                    <input type="text" name="grand_dam" placeholder="Grand Dam" class="border rounded p-2" required>
                    <input type="date" name="date_of_birth" class="border rounded p-2" required>
                    <input type="text" name="birth_weight" placeholder="Birth Weight" class="border rounded p-2" required>
                    <input type="text" name="source" placeholder="Source" class="border rounded p-2" required>
                    <input type="date" name="date_purchased" placeholder="Date Purchased" class="border rounded p-2" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Register Cow</button>
                    <button type="button" id="closeModalBtn" class="bg-gray-500 text-white px-4 py-2 rounded-lg ml-4">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Automatically display the modal on page load
        window.addEventListener('load', function() {
            document.getElementById('newRecordModal').classList.remove('hidden');
        });

        // Handle closing the modal
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('newRecordModal').classList.add('hidden');
        });

        // Handle form submission (optional)
        document.getElementById('newRecordForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Handle form submission logic here
            this.submit(); // Uncomment this line to actually submit the form
        });
    </script>
</body>

</html>
