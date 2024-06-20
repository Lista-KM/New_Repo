<?php
include("includes/config.php"); // Include your database connection file

$sql = "SELECT * FROM feed_formulation";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feed Formulations</title>
  <style>
    /* Add your CSS styles here */
  </style>
</head>

<body>
  <div class="flex justify-between items-center mb-4">
    <button class="bg-zinc-200 text-zinc-800 px-4 py-2 rounded">Print</button>
    <div class="flex items-center">
      <label for="search" class="mr-2">Search:</label>
      <input type="text" id="search" class="border border-zinc-300 rounded px-2 py-1" />
    </div>
  </div>
  <div class="container mx-auto p-4">
    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse block md:table">
        <thead class="block md:table-header-group">
          <tr class="border border-zinc-300 md:border-none block md:table-row">
            <th class="bg-zinc-200 p-2 text-left font-medium text-black block md:table-cell">Date</th>
            <th class="bg-zinc-200 p-2 text-left font-medium text-black block md:table-cell">Item</th>
            <th class="bg-zinc-200 p-2 text-left font-medium text-black block md:table-cell">Quantity</th>
            <th class="bg-zinc-200 p-2 text-left font-medium text-black block md:table-cell">Actions</th>
          </tr>
        </thead>
        <tbody class="block md:table-row-group">
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr class='border border-zinc-300 md:border-none block md:table-row'>";
                  echo "<td class='p-2 block md:table-cell'>" . $row["formulation_date"] . "</td>";
                  echo "<td class='p-2 block md:table-cell text-blue-500'>" . $row["item_name"] . "</td>";
                  echo "<td class='p-2 block md:table-cell'>" . $row["quantity"] . "</td>";
                  echo "<td class='p-2 block md:table-cell'>
                        <button class='bg-zinc-300 p-1 rounded'>
                          <img aria-hidden='true' alt='edit' src='https://placehold.co/16x16' />
                        </button>
                        <button class='bg-red-500 p-1 rounded'>
                          <img aria-hidden='true' alt='delete' src='https://placehold.co/16x16' />
                        </button>
                      </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr class='border border-zinc-300 md:border-none block md:table-row'>";
              echo "<td colspan='4' class='p-2 block md:table-cell'>No records found</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>

<?php
$conn->close();
?>
