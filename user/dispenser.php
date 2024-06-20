<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate inputs
$feed_date = $_POST['feed_date'];
$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];
$group_name = $_POST['group_name'];
$stock_id = $_POST['stock_id'];
// Validate if any field is empty
if (empty($feed_date) || empty($item_name) || empty($quantity) || empty($group_name) || empty($stock_id)) {
  die("Please fill in all fields.");
}

// Database connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dfsms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert data into daily_feeding table
$stmt = $conn->prepare("INSERT INTO daily_feeding (feed_date, item_name, quantity, group_name, stock_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssisi", $feed_date, $item_name, $quantity, $group_name, $stock_id);

// Execute SQL statement
if ($stmt->execute()) {
  echo "Form submitted successfully!";
} else {
  echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
exit(); // Prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Item Popup</title>
  <style>
    /* Styling for the feeding form */
    .max-w-lg {
      max-width: 30rem;
    }

    .mx-auto {
  margin-left: auto;
  margin-right: auto;
}

.dark\:bg-zinc-800 {
  background-color: white; /* Adjust the color code accordingly */
}

.shadow-md {
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.rounded-lg {
  border-radius: 0.5rem;
}

.p-6 {
  padding: 1.5rem;
}

.flex {
  display: flex;
}

.justify-between {
  justify-content: space-between;
}

.items-center {
  align-items: center;
}

.mb-4 {
  margin-bottom: 1rem;
}

.mr-2 {
  margin-right: 0.5rem;
}

.text-lg {
  font-size: 1.125rem;
}

.text-black {
  color: #000000; /* Dark black color */
}

.border-b {
  border-bottom-width: 1px;
}

.border-zinc-300 {
  border-color: #d1d5db; /* Adjust the color code accordingly */
}

.dark\:border-zinc-700 {
  border-color: #9ca3af; /* Adjust the color code accordingly */
}

.text-center {
  text-align: center;
}

.text-blue-500 {
  color: #3b82f6; /* Adjust the color code accordingly */
}

.dark\:text-blue-400 {
  color: #93c5fd; /* Adjust the color code accordingly */
}

.grid {
  display: grid;
}

.grid-cols-1 {
  grid-template-columns: repeat(1, minmax(0, 1fr));
}

.md\:grid-cols-2 {
  grid-template-columns: repeat(2, minmax(0, 1fr));
}

.gap-4 {
  gap: 1rem;
}

.border {
  border-width: 1px;
}

.rounded {
  border-radius: 0.375rem;
}

.p-2 {
  padding: 0.5rem;
}

.w-full {
  width: 100%;
}

.focus\:outline-none:focus {
  outline: none;
}

.justify-end {
  justify-content: flex-end;
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

/* Overlay styling */
body {
  margin: 0;
  padding: 0;
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
</head>
<body>
  <div class="overlay">
    <div class="max-w-lg mx-auto dark:bg-zinc-800 shadow-md rounded-lg p-6">
      <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
          <h2 class="text-black text-lg">Enter daily feeding</h2>
        </div>
        <a href="feeds.php">
          <button class="text-zinc-500 dark:text-zinc-400">&times;</button>
        </a>
      </div>
      <div class="border-b border-zinc-300 dark:border-zinc-700 mb-4"></div>
      <div class="text-center mb-4">
        <h3 class="text-blue-500 dark:text-blue-400">Feeding details</h3>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <input id="datepicker" type="date" name="feed_date" class="w-full bg-transparent focus:outline-none" />
        </div>
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <select id="itemSelect" class="w-full bg-transparent focus:outline-none">
            <option value="">Loading items...</option> <!-- Initial placeholder -->
          </select>
        </div>
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <input id="quantityInput" type="text" name="quantity" placeholder="Quantity" class="w-full bg-transparent focus:outline-none" />
        </div>
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <select id="groupSelect" name="group_name" class="w-full bg-transparent focus:outline-none">
            <option value="">Group</option>
          </select>
        </div>
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <input id="stockIdInput" type="text" name="stock_id" placeholder="Stock ID" class="w-full bg-transparent focus:outline-none" />
        </div>
      </div>
      <div class="flex justify-end">
        <button id="submitButton" class="bg-yellow-500 text-white px-4 py-2 rounded">Submit</button>
      </div>
    </div>
  </div>
  
  <script>
    // Function to close the popup
    function closePopup() {
      window.location.href = 'feeds.php'; // Redirect to feeds.php when closing
    }

    // Event listener for close button
    document.querySelector('.overlay').addEventListener('click', function (event) {
      if (event.target.classList.contains('overlay')) {
        closePopup();
      }
    });

    // Function to populate items select box from database
    function populateItems() {
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const items = JSON.parse(xhr.responseText);
            const itemSelect = document.getElementById('itemSelect');

            // Clear previous options
            itemSelect.innerHTML = '<option value="">Select item...</option>';

            // Populate with new options
            items.forEach(item => {
              const option = document.createElement('option');
              option.value = item.id;
              option.textContent = item.name;
              itemSelect.appendChild(option);
            });
          } else {
            console.error('Failed to fetch items');
          }
        }
      };

      xhr.open('GET', 'fetch_items.php');
      xhr.send();
    }

    // Populate items select box on page load
    populateItems();

    // Form validation function
    function validateForm() {
      const date = document.getElementById('datepicker').value;
      const itemId = document.getElementById('itemSelect').value;
      const quantity = document.getElementById('quantityInput').value;
      const group = document.getElementById('groupSelect').value;
      const stockId = document.getElementById('stockIdInput').value;

      if (date === '' || itemId === '' || quantity === '' || group === '' || stockId === '') {
        alert('Please fill in all fields.');
        return false;
      }

      return true;
    }

    // Event listener for form submission
    document.getElementById('submitButton').addEventListener('click', function (event) {
      event.preventDefault();

      if (validateForm()) {
        const formData = new FormData();
        formData.append('feed_date', document.getElementById('datepicker').value);
        formData.append('item_name', document.getElementById('itemSelect').value);
        formData.append('quantity', document.getElementById('quantityInput').value);
        formData.append('group_name', document.getElementById('groupSelect').value);
        formData.append('stock_id', document.getElementById('stockIdInput').value);

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              alert('Form submitted successfully!');
              fetchFeedingRecords(); // Refresh the feeding records table
              closePopup(); // Close popup after successful submission
            } else {
              alert('Failed to submit form: ' + xhr.statusText);
            }
          }
        };

        xhr.open('POST', 'submit_feeding.php');
        xhr.send(formData);
      }
    });

    // Function to fetch feeding records
    function fetchFeedingRecords() {
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const records = JSON.parse(xhr.responseText);
            const recordsTableBody = document.getElementById('recordsTableBody');

            // Clear previous records
            recordsTableBody.innerHTML = '';

            // Populate with new records
            records.forEach(record => {
              const row = document.createElement('tr');

              row.innerHTML = `
                <td>${record.feed_date}</td>
                <td>${record.item_name}</td>
                <td>${record.quantity}</td>
                <td>${record.group_name}</td>
                <td>
                  <button onclick="editRecord(${record.id})">Edit</button>
                  <button onclick="deleteRecord(${record.id})">Delete</button>
                </td>
              `;
              recordsTableBody.appendChild(row);
            });
          } else {
            console.error('Failed to fetch feeding records');
          }
        }
      };

      xhr.open('GET', 'fetch_feeding_records.php');
      xhr.send();
    }

    // Function to edit a record
    function editRecord(id) {
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const record = JSON.parse(xhr.responseText);

            // Populate form with record data for editing
            document.getElementById('datepicker').value = record.feed_date;
            document.getElementById('itemSelect').value = record.item_name;
            document.getElementById('quantityInput').value = record.quantity;
            document.getElementById('groupSelect').value = record.group_name;
            document.getElementById('stockIdInput').value = record.stock_id;

            // Add a hidden input to store the record id
            let recordIdInput = document.getElementById('recordId');
            if (!recordIdInput) {
              recordIdInput = document.createElement('input');
              recordIdInput.type = 'hidden';
              recordIdInput.id = 'recordId';
              document.querySelector('.overlay').appendChild(recordIdInput);
            }
            recordIdInput.value = record.id;
          } else {
            console.error('Failed to fetch record for editing');
          }
        }
      };

      xhr.open('GET', `fetch_record.php?id=${id}`);
      xhr.send();
    }

    // Function to delete a record
    function deleteRecord(id) {
      if (confirm('Are you sure you want to delete this record?')) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              fetchFeedingRecords(); // Refresh the feeding records table
            } else {
              console.error('Failed to delete record');
            }
          }
        };

        xhr.open('GET', `delete_record.php?id=${id}`);
        xhr.send();
      }
    }

    // Fetch feeding records on page load
    fetchFeedingRecords();
  </script>
</body>
</html>