<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Item Popup</title>
  <style>
    /* Styling for Add New Item Popup */
    .input-field {
      border: 1px solid #d1d5db;
      border-radius: 0.5rem;
      padding: 0.5rem;
      transition: border-color 0.2s;
    }

    .input-field:focus {
      border-color: #f6d365;
    }

    .submit-button {
      background-color: #f6d365;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .submit-button:hover {
      background-color: #fda085;
    }

    @media (max-width: 768px) {
      /* Additional styles for smaller screens if needed */
    }

    /* Additional styles for the component */
    .popup {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      max-width: 24rem; /* Adjust as needed */
      width: 100%;
      background-color: #ffffff;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      border-radius: 0.75rem; /* Adjust as needed */
      overflow: hidden;
      display: block; /* Show the popup initially */
    }

    .popup-content {
      padding: 1rem;
    }

    .border-b {
      border-bottom-width: 1px;
    }

    .dark:border-zinc-700 {
      border-color: #4b5563; /* Adjust as needed */
    }

    .text-lg {
      font-size: 1.125rem; /* Adjust as needed */
    }

    .font-semibold {
      font-weight: 600;
    }

    .text-zinc-800 {
      color: #1f2937; /* Adjust as needed */
    }

    .dark:text-zinc-200 {
      color: #edf2f7; /* Adjust as needed */
    }

    .mr-2 {
      margin-right: 0.5rem;
    }

    .mb-4 {
      margin-bottom: 1rem;
    }

    .grid {
      display: grid;
    }

    .grid-cols-1 {
      grid-template-columns: repeat(1, minmax(0, 1fr));
    }

    .sm\:grid-cols-2 {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .gap-4 {
      gap: 1rem;
    }

    .justify-center {
      justify-content: center;
    }

    .px-4 {
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .border-b-2 {
      border-bottom-width: 2px;
    }

    .border-transparent {
      border-color: transparent;
    }

    .text-zinc-500 {
      color: #6b7280; /* Adjust as needed */
    }

    .dark:text-zinc-400 {
      color: #9ca3af; /* Adjust as needed */
    }

    .flex-end {
      justify-content: flex-end;
    }

    /* Close button styling */
    .close-button {
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      background: none;
      border: none;
      cursor: pointer;
      outline: none;
      padding: 0;
      margin: 0;
      font-size: 1.5rem;
      color: #6b7280; /* Adjust color as needed */
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Your existing content goes here -->
  </div>

  <!-- Popup Section -->
  <div class="popup" id="popup">
    <div class="popup-content">
      <div class="flex items-center justify-between p-4 border-b">
        <h2 class="text-lg font-semibold">Add New Feed Item</h2>
        <button class="close-button" id="closeButton">&times;</button>
      </div>
      <div class="p-4">
        <form id="feedForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="flex justify-center mb-4">
            <span class="border-b-2 border-transparent px-4">Item Details</span>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <input type="text" name="item_name" placeholder="Item Name" class="input-field" required>
            <input type="text" name="unit_of_measure" placeholder="Unit" class="input-field" required>
            <input type="text" name="available_stock" placeholder="Available Stock" class="input-field" required>
            <input type="number" step="0.01" name="unit_price" placeholder="Unit Price" class="input-field" required>
          </div>
          <div class="flex justify-end">
            <button type="submit" class="submit-button" id="submitButton">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // JavaScript to handle the close button functionality and redirection
    document.addEventListener('DOMContentLoaded', function () {
      const closeButton = document.getElementById('closeButton');
      const submitButton = document.getElementById('submitButton');
      const popup = document.getElementById('popup');

      if (closeButton) {
        closeButton.addEventListener('click', function () {
          window.location.href = 'feeds.php'; // Redirect to feeds page when close button is clicked
        });
      }

      if (submitButton) {
        submitButton.addEventListener('click', function () {
          document.getElementById('feedForm').submit(); // Submit the form and redirect to feeds page
        });
      }
    });
  </script>

<?php
// Include the database configuration file
include '../includes/config.php';

// Define variables and initialize with empty values
$item_name = $unit_of_measure = $unit_price = $available_stock = "";
$item_name_err = $unit_of_measure_err = $unit_price_err = $available_stock_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate feed name
    if (empty(trim($_POST["item_name"]))) {
        $iten_name_err = "Please enter item name.";
    } else {
        $item_name = trim($_POST["item_name"]);
    }

    // Validate unit of measure
    if (empty(trim($_POST["unit_of_measure"]))) {
        $unit_of_measure_err = "Please enter unit of measure.";
    } else {
        $unit_of_measure = trim($_POST["unit_of_measure"]);
    }

    // Validate unit price
    if (empty(trim($_POST["unit_price"]))) {
        $unit_price_err = "Please enter unit price.";
    } elseif (!is_numeric($_POST["unit_price"])) {
        $unit_price_err = "Please enter a valid unit price.";
    } else {
        $unit_price = trim($_POST["unit_price"]);
    }

    // Validate available stock
    if (empty(trim($_POST["available_stock"]))) {
        $available_stock_err = "Please enter available stock.";
    } elseif (!ctype_digit($_POST["available_stock"])) {
        $available_stock_err = "Please enter a positive integer value for available stock.";
    } else {
        $available_stock = trim($_POST["available_stock"]);
    }

    // Check input errors before inserting into database
    if (empty($item_name_err) && empty($unit_of_measure_err) && empty($unit_price_err) && empty($available_stock_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO feed_items (item_name, unit_of_measure, unit_price, available_stock) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssdi", $item_name, $unit_of_measure, $unit_price, $available_stock);

            // Set parameters
            $item_name = $_POST['item_name'];
            $unit_of_measure = $_POST['unit_of_measure'];
            $unit_price = $_POST['unit_price'];
            $available_stock = $_POST['available_stock'];

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo "<script>alert('Records added successfully.');</script>";
                echo "<script>window.location.href = 'feeds.php';</script>";
            } else {
                echo "ERROR: Could not execute query: $sql. " . $conn->error;
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>

</body>

</html>
