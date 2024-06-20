<?php
include("../header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feeding Management</title>
  <style>
    /* Your existing CSS styles */
    /* Base Styles */
    body {
      font-family: 'Arial', sans-serif;
      background-color: whitesmoke;
      margin: 0;
      padding: 0;
    }

    .p-4 {
      padding: 1rem;
    }

    /* Heading */
    .text-xl {
      font-size: 1.25rem;
      color: #333;
    }

    .font-bold {
      font-weight: bold;
    }

    .mb-4 {
      margin-bottom: 1rem;
    }

    /* Buttons */
    button {
      background: linear-gradient(45deg, #f6d365, #fda085);
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Flex Containers */
    .flex {
      display: flex;
      align-items: center;
    }

    .space-x-2 > * + * {
      margin-left: 0.5rem;
    }

    .space-x-4 > * + * {
      margin-left: 1rem;
    }

    /* Align right utility */
    .ml-auto {
      margin-left: auto;
    }

    /* Select */
    select {
      padding: 0.5rem;
      border-radius: 0.5rem;
      border: 1px solid #d1d5db;
      background-color: white;
    }

    /* Card */
    .bg-white {
      background-color: white;
    }

    .shadow {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .rounded {
      border-radius: 0.5rem;
    }

    /* Navigation */
    nav a {
      padding: 0.5rem 1rem;
      color: #555;
      text-decoration: none;
      transition: color 0.2s, border-bottom 0.2s;
    }

    nav a:hover {
      color: #333;
      border-bottom: 2px solid #f6d365;
    }

    .border-b {
      border-bottom: 1px solid #e5e7eb;
    }

    .border-zinc-200 {
      border-color: #e5e7eb;
    }

    .border-zinc-300 {
      border-color: #d1d5db;
    }

    .border-b-2 {
      border-bottom-width: 2px;
    }

    .border-yellow-500 {
      border-color: #f6d365;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 0.75rem;
      border-bottom: 1px solid #e5e7eb;
      text-align: left;
    }

    thead {
      background-color: #f9fafb;
    }

    tbody tr:nth-child(odd) {
      background-color: #f3f4f6;
    }

    tbody tr:hover {
      background-color: #e5e7eb;
    }

    /* Input */
    input[type="text"] {
      padding: 0.5rem;
      border-radius: 0.5rem;
      border: 1px solid #d1d5db;
      background-color: white;
      transition: border-color 0.2s;
    }

    input[type="text"]:focus {
      border-color: #f6d365;
    }

    /* Misc */
    .mr-2 {
      margin-right: 0.5rem;
    }

    .py-2 {
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
    }

    .px-4 {
      padding-left: 1rem;
      padding-right: 1rem;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .flex {
        flex-direction: column;
        align-items: stretch;
      }

      .space-x-2 > * + *, .space-x-4 > * + * {
        margin-left: 0;
        margin-top: 0.5rem;
      }

      nav {
        flex-direction: column;
      }

      nav a {
        margin-bottom: 0.5rem;
      }

      table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }

      th, td {
        white-space: nowrap;
      }
    }

    .popup-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .popup-content {
      background-color: #fff;
      padding: 1rem;
      border-radius: 0.5rem;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body>
  <div class="p-4">
    <h1 class="text-xl font-bold mb-4">Feeding</h1>
    <div class="flex mb-4">
      <div class="ml-auto space-x-2">
      <!--<button class="bg-yellow-500 text-white px-4 py-2 rounded">+ Stock</button> -->
      <button id="openAddItemPopup" class="bg-yellow-500 text-white px-4 py-2 rounded">+ Add Item</button>
      <button id="openDispensePopupButton" class="bg-yellow-500 text-white px-4 py-2 rounded">Dispense Feeds</button>
      <button id="openFormulatePopup" class="bg-yellow-500 text-white px-4 py-2 rounded">+ Formulate Feeds</button>
        </div>
    </div>
    <div class="flex items-center mb-4">
      <select class="border border-zinc-300 p-2 rounded mr-2">
        <option>Select month</option>
      </select>
      <button class="bg-yellow-500 text-white px-4 py-2 rounded">Retrieve</button>
    </div>
    <div class="bg-white shadow rounded">
  <div class="border-b border-zinc-200">
    <nav class="flex space-x-4">
      <a href="#" class="py-2 px-4 text-black border-b-2 border-yellow-500 font-semibold" onclick="showContent('stockLevels')">Stock Levels</a>
      <a href="#" class="py-2 px-4 text-black font-semibold" onclick="showContent('feedOrders')"></a>
      <a href="#" class="py-2 px-4 text-black font-semibold" onclick="showContent('feedingProgram')"></a>
      <a href="#" class="py-2 px-4 text-black font-semibold" onclick="showContent('dailyFeeding')">Daily Feeding</a>
      <a href="#" class="py-2 px-4 text-black font-semibold" onclick="showContent('feedOrders')"></a>
      <a href="#" class="py-2 px-4 text-black font-semibold" onclick="showContent('feedingProgram')"></a>
      <a href="#" class="py-2 px-4 text-black font-semibold" onclick="showContent('feedFormulation')">Feed Formulation</a>
    </nav>
  </div>
</div>

        <div id="stockLevelsContent">
          <?php
          include("../stocklevels.php");
          ?>

        </div>
        <div id="feedOrdersContent" style="display: none;">
          <!-- Content for Feed Orders tab -->
          <?php
          include("../stocklevels.php");
          ?>
        </div>
        <div id="feedingProgramContent" style="display: none;">
          <!-- Content for Feeding Program tab -->
          <?php
          include("../stocklevels.php");
          ?>
        </div>
        <div id="dailyFeedingContent" style="display: none;">
          <!-- Content for Daily Feeding tab -->
          <?php
          include("../dailyfeeds.php");
          ?>
        </div>
        <div id="feedFormulationContent" style="display: none;">
          <!-- Content for Feed Formulation tab -->
          <?php
          include("../feedformulation.php");
          ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    function showContent(tabName) {
      // Hide all content divs
      var contentDivs = document.querySelectorAll('[id$="Content"]');
      contentDivs.forEach(function(div) {
        div.style.display = 'none';
      });

      // Show the selected content div
      var selectedContent = document.getElementById(tabName + 'Content');
      if (selectedContent) {
        selectedContent.style.display = 'block';
      }
    }
  </script>

   <!-- Popup content for addnewitem.php -->
<div id="addNewItemPopup" class="popup-overlay">
  <div class="popup-content">
    <!-- Popup header, body, and form -->
    <?php
      include("../addnewitem.php");
    ?>
  </div>
</div>

<!-- JavaScript code to toggle the add new item popup -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const openAddItemPopupButton = document.getElementById('openAddItemPopup');
    const addNewItemPopup = document.getElementById('addNewItemPopup');

    openAddItemPopupButton.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default link behavior
      addNewItemPopup.style.display = 'block';
    });
  });
</script>

<!-- Popup content for formulate.php -->
<div id="formulatePopup" class="popup-overlay">
  <div class="popup-content">
    <!-- Popup header, body, and form -->
    <?php
      include("../formulate.php");
    ?>
  </div>
</div>

<!-- JavaScript code to toggle the formulate popup -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const openFormulatePopupButton = document.getElementById('openFormulatePopup');
    const formulatePopup = document.getElementById('formulatePopup');

    openFormulatePopupButton.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default link behavior
      formulatePopup.style.display = 'block';
    });
  });
</script>

<!-- Popup content for dispensing feeds -->
<div id="dispensePopup" class="popup-overlay">
  <div class="popup-content">
    <!-- Popup header, body, and form -->
    <?php
      include("../dispenser.php"); // Assuming "dispense.php" contains the content for dispensing feeds
    ?>
  </div>
</div>

<!-- JavaScript code to toggle the dispense popup -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const openDispensePopupButton = document.getElementById('openDispensePopupButton');
    const dispensePopup = document.getElementById('dispensePopup');

    openDispensePopupButton.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default button behavior
      dispensePopup.style.display = 'block';
    });
  });
</script>

</body>
</html>

