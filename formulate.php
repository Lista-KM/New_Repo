<?php
include("includes/config.php"); // Include your database connection file

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get form data
        $formulation_date = $_POST['formulation_date'];
        $item_name = $_POST['item_name'];
        $quantity = $_POST['quantity'];

        // Validate form data
        if (!empty($formulation_date) && !empty($item_name) && !empty($quantity)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO feed_formulation (formulation_date, item_name, quantity) VALUES (?, ?, ?)");
            if ($stmt === false) {
                $error_message = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            } else {
                $stmt->bind_param("ssi", $formulation_date, $item_name, $quantity);

                // Execute the statement
                if ($stmt->execute()) {
                    $success_message = "New feed formulation record created successfully";
                } else {
                    $error_message = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            }
        } else {
            $error_message = "Please fill in all fields.";
        }
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulate Feeds</title>
    <style>
        /* Styling for the popup */
        .fixed {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .max-w-lg {
            max-width: 30rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .p-4 {
            padding: 1rem;
        }

        .bg-white {
            background-color: #fff;
        }

        .dark\:bg-zinc-800 {
            background-color: #4b5563;
        }

        .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .border-b {
            border-bottom-width: 1px;
        }

        .pb-2 {
            padding-bottom: 0.5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-zinc-800 {
            color: #4b5563;
        }

        .dark\:text-zinc-200 {
            color: #d1d5db;
        }

        .grid {
            display: grid;
        }

        .grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .gap-4 {
            gap: 1rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-green-600 {
            color: #34d399;
        }

        .border {
            border-width: 1px;
        }

        .rounded-md {
            border-radius: 0.375rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .bg-yellow-500 {
            background-color: #f59e0b;
        }

        .text-white {
            color: #fff;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>
</head>

<body>
    <div id="popup" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 max-w-lg mx-auto p-4 bg-white dark:bg-zinc-800 shadow-md rounded-lg">
        <div class="border-b pb-2 mb-4">
            <h2 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">Process Feeds</h2>
            <button id="closeButton" class="text-zinc-500 dark:text-zinc-400">&times;</button>
        </div>
        <?php if (!empty($success_message)): ?>
            <div class="mb-4">
                <span class="text-green-600"><?php echo $success_message; ?></span>
            </div>
        <?php elseif (!empty($error_message)): ?>
            <div class="mb-4">
                <span class="text-red-600"><?php echo $error_message; ?></span>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
    <div class="grid grid-cols-4 gap-4 mb-4">
        <div>
            <label class="block text-sm font-semibold text-green-600">Date</label>
            <input type="date" name="formulation_date" class="mt-1 block w-full border border-green-600 rounded-md p-2" />
        </div>
        <div>
            <label class="block text-sm font-semibold text-green-600">Item</label>
            <select name="item_name" class="mt-1 block w-full border border-green-600 rounded-md p-2">
                <option value="">Select item...</option>
                <option value="DAIRY MI">DAIRY MI</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-green-600">Quantity</label>
            <input type="text" name="quantity" class="mt-1 block w-full border border-green-600 rounded-md p-2" placeholder="Quantity" />
        </div>
        <div class="flex items-end">
            <button type="submit" name="submit" class="bg-yellow-500 text-white py-2 px-4 rounded-md">Submit</button>
        </div>
    </div>
    <h3 class="text-lg font-semibold text-blue-600 mb-4">Contents</h3>
    <div class="grid grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-semibold text-green-600">Raw Material</label>
            <select class="mt-1 block w-full border border-green-600 rounded-md p-2">
                <option value="">Select item...</option>
                <!-- Add options for raw materials as needed -->
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-green-600">Quantity</label>
            <input type="text" class="mt-1 block w-full border border-green-600 rounded-md p-2" placeholder="Quantity" />
        </div>
        <div class="flex items-end">
            <button type="button" class="bg-yellow-500 text-white py-2 px-4 rounded-md">Submit</button>
        </div>
    </div>
</form>

    </div>

    <script>
        document.getElementById('closeButton').addEventListener('click', function() {
            window.location.reload();
        });
    </script>
</body>

</html>
