<?php
require_once('../includes/config.php'); 

// Handle Add New Item (POST Request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
    $unitOfMeasure = mysqli_real_escape_string($conn, $_POST['unitOfMeasure']);
    $unitPrice = mysqli_real_escape_string($conn, $_POST['unitPrice']);
    $availableStock = mysqli_real_escape_string($conn, $_POST['availableStock']);

    // Prepare and execute the SQL statement to insert data
    $sql = "INSERT INTO items (itemName, unitOfMeasure, unitPrice, availableStock)
            VALUES ('$itemName', '$unitOfMeasure', '$unitPrice', '$availableStock')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "New item added successfully";
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Item Popup</title>
  <style>
    /* Reset box sizing */
    * {
      box-sizing: border-box;
    }
    .input-field {
      border: 1px solid #d1d5db;
      border-radius: 0.5rem;
      padding: 0.5rem;
      transition: border-color 0.2s;
    }

    .input-field:focus {
      border-color: #f6d365;
      outline: none;
    }

    .submit-button {
      background-color: #f6d365;
      color: white;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 0.5rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .submit-button:hover {
      background-color: #fda085;
    }

    .popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      max-width: 24rem; /* Adjust as needed */
      width: 100%;
      background-color: #ffffff;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      border-radius: 0.75rem; /* Adjust as needed */
      overflow: hidden;
      z-index: 1000;
      display: none; /* Initially hidden */
    }

    .popup-content {
      padding: 1rem;
    }

    .border-b {
      border-bottom-width: 1px;
    }

    .dark\:border-zinc-700 {
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

    .dark\:text-zinc-200 {
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

    .dark\:text-zinc-400 {
      color: #9ca3af; /* Adjust as needed */
    }

    .flex-end {
      justify-content: flex-end;
    }

    .flex {
      display: flex;
    }

    .items-center {
      align-items: center;
    }

    .justify-between {
      justify-content: space-between;
    }

    .p-4 {
      padding: 1rem;
    }

    .close-button {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <!-- Your existing HTML content here -->
  <div class="popup" id="popup">
    <div class="popup-content">
    <div class="container">
    <!-- The only + Add Item button, located on the feeds page -->
    <button id="addItemButton" class="open-popup-button">+ Add Item</button>
  </div>
  <div class="popup" id="popup">
    <div class="popup-content">
      <div class="flex items-center justify-between p-4 border-b dark:border-zinc-700">
        <div class="flex items-center">
          <img aria-hidden="true" alt="edit" src="https://placehold.co/24x24" class="mr-2" />
          <h2 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">New Feed Item</h2>
        </div>
        <button class="close-button text-zinc-500 dark:text-zinc-400" onclick="closePopup()">&times;</button>
      </div>
      <div class="p-4">
        <div class="flex justify-center mb-4">
          <span class="border-b-2 border-transparent text-zinc-500 dark:text-zinc-400 px-4">Item Details</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
          <input type="text" placeholder="Item Name" class="input-field" />
          <input type="text" placeholder="Unit of Measure" class="input-field" />
          <input type="text" placeholder="Unit Price" class="input-field" />
          <input type="text" placeholder="Available Stock" class="input-field" />
        </div>
        <div class="flex justify-end">
          <button class="submit-button">Submit</button>
        </div>
      </div>
    </div>
  </div>
      <div class="flex justify-end">
        <!-- Display success message if item added successfully -->
        <?php if (isset($successMessage)): ?>
          <p><?php echo $successMessage; ?></p>
        <?php endif; ?>
        <!-- Display error message if there was an error -->
        <?php if (isset($errorMessage)): ?>
          <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script>
    function openPopup() {
      document.getElementById('popup').style.display = 'block';
    }

    function closePopup() {
      document.getElementById('popup').style.display = 'none';
    }

    document.getElementById('addItemButton').addEventListener('click', openPopup);
  </script>
</body>
</html>







 <!-- Popup content for addnewitem.php -->

   <!--
<div id="addNewItemPopup" class="popup-overlay">
  <div class="popup-content">
  <?php
      include("../addnewitem.php");
    ?>
  </div>
</div>-->

<!-- JavaScript code to toggle the add new item popup -->
<!--<script>
  document.addEventListener('DOMContentLoaded', function() {
    const openAddItemPopupButton = document.getElementById('openAddItemPopup');
    const addNewItemPopup = document.getElementById('addNewItemPopup');

    openAddItemPopupButton.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default link behavior
      addNewItemPopup.style.display = 'block';
    });
  });
</script>-->

<!-- Popup content for formulate.php -->
<!--<div id="formulatePopup" class="popup-overlay">
  <div class="popup-content">
    <?php
      include("../formulate.php");
    ?>
  </div>
</div>-->

<!-- JavaScript code to toggle the formulate popup -->
<!--<script>
  document.addEventListener('DOMContentLoaded', function() {
    const openFormulatePopupButton = document.getElementById('openFormulatePopup');
    const formulatePopup = document.getElementById('formulatePopup');

    openFormulatePopupButton.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default link behavior
      formulatePopup.style.display = 'block';
    });
  });
</script>-->

<!-- Popup content for dispensing feeds -->
<!--<div id="dispensePopup" class="popup-overlay">
  <div class="popup-content">
    <?php
      include("../dispenser.php"); // Assuming "dispense.php" contains the content for dispensing feeds
    ?>
  </div>
</div>-->
<!-- JavaScript code to toggle the dispense popup -->
<!--<script>
  document.addEventListener('DOMContentLoaded', function() {
    const openDispensePopupButton = document.getElementById('openDispensePopupButton');
    const dispensePopup = document.getElementById('dispensePopup');

    openDispensePopupButton.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default button behavior
      dispensePopup.style.display = 'block';
    });
  });
</script> -->

<!-- 

<div id="stockPopup" class="popup-overlay">
  <div class="popup-content">
    <?php
      include("../addstock.php"); // Assuming "add_stock.php" contains the form for adding stock items
    ?>
  </div>
</div> -->

<!--<script>
  document.addEventListener('DOMContentLoaded', function() {
    const openStockPopupButton = document.getElementById('openStockPopupButton');
    const stockPopup = document.getElementById('stockPopup');

    openStockPopupButton.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default button behavior
      stockPopup.style.display = 'block';
    });
  });
</script>
-->