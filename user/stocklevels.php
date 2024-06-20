<?php
// Assuming you have already established a database connection
include("../includes/config.php");
// Query to select data from the stock_levels table
$sql = "SELECT * FROM stock_levels";
$result = mysqli_query($conn, $sql);

// Check if there are rows returned
if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <button class="bg-zinc-200 text-zinc-800 px-4 py-2 rounded">Print</button>
            <div class="flex items-center">
                <label for="search" class="mr-2">Search:</label>
                <input type="text" id="search" class="border border-zinc-300 rounded px-2 py-1" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-zinc-300">
                <thead>
                    <tr class="bg-zinc-200 text-zinc-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Feeds</th>
                        <th class="py-3 px-4 text-left">Quantity</th>
                        <th class="py-3 px-4 text-left">Unit</th>
                        <th class="py-3 px-4 text-left">Unit Price</th>
                        <th class="py-3 px-4 text-left">Total Value</th>
                        <th class="py-3 px-4 text-left">Consumed</th>
                        <th class="py-3 px-4 text-left">Consumption(Ksh)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each row in the result set
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="py-3 px-4"><?php echo $row['id']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['feed_name']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['quantity']; ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['unit']); ?></td>
                            <td class="py-3 px-4"><?php echo $row['unit_price']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['total_value']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['consumed']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['consumption_ksh']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
} else {
    echo "No records found";
}

// Close the database connection
mysqli_close($conn);
?>
