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
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
            z-index: 1000; /* Ensure popup stays on top */
        }

        .popup {
            max-width: 30rem;
            width: 100%;
            background-color: #fff;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .popup .close-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            cursor: pointer;
            color: #4b5563;
            font-size: 1.5rem;
        }

        .popup .content {
            margin-bottom: 1rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .form-grid .input-group {
            display: flex;
            flex-direction: column;
        }

        .form-grid .input-group label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        .form-grid .input-group select,
        .form-grid .input-group input[type="date"],
        .form-grid .input-group input[type="text"] {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.75rem;
            font-size: 0.875rem;
        }

        .form-grid .input-group select {
            appearance: none;
            background-image: url('data:image/svg+xml,%3Csvg viewBox="0 0 20 20" fill="currentColor"%3E%3Cpath fill-rule="evenodd" d="M15.293 4.293a1 1 0 0 1 1.414 1.414l-10 10a1 1 0 0 1-1.414 0l-10-10a1 1 0 1 1 1.414-1.414L5 11.086V5a1 1 0 1 1 2 0v5.586l5.293-5.293a1 1 0 0 1 1.414 0z" clip-rule="evenodd"%3E%3C/path%3E%3C/svg%3E');
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        .form-grid .input-group button {
            background-color: #f59e0b;
            color: #fff;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .form-grid .input-group button:hover {
            background-color: #ed8936;
        }

        .form-grid .input-group .submit-btn {
            grid-column: span 2; /* Span full width of grid */
        }
    </style>
</head>

<body>
    <div class="fixed">
        <div class="popup">
            <button class="close-btn" id="closeButton">&times;</button>
            <div class="content">
                <h2 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200 mb-4">Process Feeds</h2>
                <div id="messageContainer">
                    <!-- Message container for success or error messages -->
                </div>
                <form id="feedForm" method="POST">
                    <div class="form-grid">
                        <div class="input-group">
                            <label for="formulation_date">Date</label>
                            <input type="date" id="formulation_date" name="formulation_date" class="mt-1 block w-full border border-green-600 rounded-md p-2" required />
                        </div>
                        <div class="input-group">
                            <label for="item_name">Item</label>
                            <select id="item_name" name="item_name" class="mt-1 block w-full border border-green-600 rounded-md p-2" required>
                                <option value="">Select item...</option>
                                <option value="DAIRY MI">DAIRY MI</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" id="quantity" name="quantity" class="mt-1 block w-full border border-green-600 rounded-md p-2" placeholder="Quantity" required />
                        </div>
                        <div class="input-group submit-btn">
                            <button type="submit" name="submit" class="mt-1 w-full">Submit</button>
                        </div>
                    </div>
                </form>
                <h3 class="text-lg font-semibold text-blue-600 mt-4 mb-2">Contents</h3>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="raw_material">Raw Material</label>
                        <select id="raw_material" class="mt-1 block w-full border border-green-600 rounded-md p-2">
                            <option value="">Select item...</option>
                            <!-- Add options for raw materials as needed -->
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="raw_quantity">Quantity</label>
                        <input type="text" id="raw_quantity" class="mt-1 block w-full border border-green-600 rounded-md p-2" placeholder="Quantity" />
                    </div>
                    <div class="input-group">
                        <button type="button" class="mt-1 w-full">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('closeButton').addEventListener('click', function() {
        window.location.href = 'feeds.php'; // Redirect to feeds.php when closing
    });

    document.getElementById('feedForm').addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Prepare form data for submission
        let formData = new FormData(this);

        // Send form data to the server using AJAX
        fetch('process_form.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Log the response for debugging
            console.log('Response from server:', data);

            // Handle the response data
            if (data.success) {
                // Display success message
                document.getElementById('messageContainer').innerHTML = `<div class="mb-4"><span class="text-green-600">${data.message}</span></div>`;

                // Optional: Close the popup after a delay
                setTimeout(() => {
                    window.location.href = 'feeds.php';
                }, 2000); // 2 seconds delay before redirecting
            } else {
                // Display error message
                document.getElementById('messageContainer').innerHTML = `<div class="mb-4"><span class="text-red-600">${data.message}</span></div>`;
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // Display error message
            document.getElementById('messageContainer').innerHTML = `<div class="mb-4"><span class="text-red-600">An error occurred. Please try again later.</span></div>`;
        });
    });
</script>

</body>

</html>
