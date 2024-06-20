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

    .text-zinc-700 {
      color: #d1d5db; /* Adjust the color code accordingly */
    }

    .dark\:text-zinc-200 {
      color: #9ca3af; /* Adjust the color code accordingly */
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
          <img aria-hidden="true" alt="edit" src="https://placehold.co/20x20" class="mr-2" />
          <h2 class="text-zinc-700 dark:text-zinc-200 text-lg">Enter daily feeding</h2>
        </div>
        <button id="addItemButton" class="text-zinc-500 dark:text-zinc-400">&times;</button>
      </div>
      <div class="border-b border-zinc-300 dark:border-zinc-700 mb-4"></div>
      <div class="text-center mb-4">
        <h3 class="text-blue-500 dark:text-blue-400">Feeding details</h3>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <img aria-hidden="true" alt="calendar" src="https://placehold.co/20x20" class="mr-2" />
          <input type="text" placeholder="Date" class="w-full bg-transparent focus:outline-none" />
        </div>
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <select class="w-full bg-transparent focus:outline-none">
            <option>Select item...</option>
          </select>
        </div>
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <input type="text" placeholder="Quantity" class="w-full bg-transparent focus:outline-none" />
        </div>
        <div class="flex items-center border border-zinc-300 dark:border-zinc-700 rounded p-2">
          <select class="w-full bg-transparent focus:outline-none">
            <option>Group</option>
          </select>
        </div>
      </div>
      <div class="flex justify-end">
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Submit</button>
      </div>
    </div>
  </div>
</body>

<script>
    function openPopup() {
      document.getElementById('popup').style.display = 'block';
    }

    function closePopup() {
      document.getElementById('popup').style.display = 'none';
    }

    document.getElementById('addItemButton').addEventListener('click', openPopup);
  </script>
</html>
