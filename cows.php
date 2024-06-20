<?php
include('../includes/config.php'); 

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
    $group_name = mysqli_real_escape_string($conn, $_POST['group']); // Corrected group_name
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
    $sql = "INSERT INTO cows (code, name, ksb_no, grade, breed, date_of_birth, current_weight, current_yield, lactations, color, category,  `group`,  sire, grand_sire, dam, grand_dam, birth_weight, source, date_purchased) 
    VALUES ('$code', '$name', '$ksb_no', '$grade', '$breed', '$color', '$category', '$farm', '$group', '$lactations', '$current_weight', '$current_yield', '$sire', '$grand_sire', '$dam', '$grand_dam', '$date_of_birth', '$birth_weight', '$date_purchased')";


    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Optional: Redirect or update the cow list on the current page
        header("Location: cows.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch cow data (all cows)
$sql = "SELECT * FROM cows"; 
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cow Records (Master file)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        /* ... (your CSS styles from the previous response) ... */
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Cow Records (Master file)</h1>
            <button id="addCowBtn" class="bg-yellow-500 text-white px-4 py-2 rounded" onclick="location.href='add_cow.php'">+ Add Cow</button>
        </div>

        <div id="newRecordModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-lg w-1/2 overflow-y-auto max-h-screen">
                <h2 class="text-lg font-bold mb-4">New Cow Record</h2>
                <form id="newRecordForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  </form>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b">
                <button class="bg-zinc-200 text-zinc-700 px-4 py-2 rounded">Print</button>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input id="search" type="text" placeholder="Search" class="border rounded px-4 py-2" />
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="cowTable" class="min-w-full bg-white">
                    <thead>
                        <tr class="w-full bg-zinc-100 border-b">
                            <th class="py-2 px-4 text-left">Code</th>
                            <th class="py-2 px-4 text-left">Name</th>
                            <th class="py-2 px-4 text-left">KSB No</th>
                            <th class="py-2 px-4 text-left">Grade</th>
                            <th class="py-2 px-4 text-left">Breed</th>
                            <th class="py-2 px-4 text-left">DOB</th>
                            <th class="py-2 px-4 text-left">Birth Wt(Kgs)</th>
                            <th class="py-2 px-4 text-left">Current Wt(Kgs)</th>
                            <th class="py-2 px-4 text-left">Yield(Kgs)</th>
                            <th class="py-2 px-4 text-left">Lactation</th>
                            <th class="py-2 px-4 text-left">Color</th>
                            <th class="py-2 px-4 text-left">Category</th>
                            <th class="py-2 px-4 text-left">Group</th>
                            <th class="py-2 px-4 text-left">Source</th>
                            <th class="py-2 px-4 text-left">Sire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<td class='py-2 px-4'>" . $row["code"] . "</td>";
                                echo "<td class='py-2 px-4 text-blue-500'>" . $row["name"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["ksb_no"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["grade"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["breed"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["date_of_birth"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["current_weight"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["current_yield"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["lactations"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["color"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["category"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["group"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["source"] . "</td>";
                                echo "<td class='py-2 px-4'>" . $row["sire"] . "</td>";

                                // ... (echo other columns)
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='15'>No cows found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   

    <script>
        // JavaScript to open/close the popup
        const addCowBtn = document.getElementById('addCowBtn');
        const newRecordModal = document.getElementById('newRecordModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const newRecordForm = document.getElementById('newRecordForm');

        addCowBtn.addEventListener('click', () => {
            newRecordModal.classList.remove('hidden');
            newRecordForm.reset(); // Reset the form when opening
        });

        closeModalBtn.addEventListener('click', () => {
            newRecordModal.classList.add('hidden');
            newRecordForm.reset(); // Reset the form when closing
        });

        newRecordForm.addEventListener
    // JavaScript to handle Active/Inactive Herd button clicks
    const activeHerdBtn = document.getElementById('activeHerdBtn');
    const inactiveHerdBtn = document.getElementById('inactiveHerdBtn');
    const activeTable = document.getElementById('activeTable');
    const inactiveTable = document.getElementById('inactiveTable');

    activeHerdBtn.addEventListener('click', () => {
        activeTable.classList.remove('hidden');
        inactiveTable.classList.add('hidden');
        activeHerdBtn.classList.add('font-bold');
        inactiveHerdBtn.classList.remove('font-bold');
    });

    inactiveHerdBtn.addEventListener('click', () => {
        inactiveTable.classList.remove('hidden');
        activeTable.classList.add('hidden');
        inactiveHerdBtn.classList.add('font-bold');
        activeHerdBtn.classList.remove('font-bold');
    });
    
    newRecordForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent default form submission

        // Get form data (using FormData for simplicity)
        const formData = new FormData(newRecordForm);
        // Send AJAX request to register_cow.php (you'll need to create this file)
        fetch('register_cow.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Handle response from server (e.g., display success/error message)
            console.log(data); 
            newRecordModal.classList.add('hidden');
            // You can also refresh the cow list here if needed
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
