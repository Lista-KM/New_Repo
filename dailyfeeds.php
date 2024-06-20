<div class="p-4">
  <div class="flex justify-between items-center mb-4">
    <div>
      <label for="entries" class="mr-2">Show</label>
      <select id="entries" class="border rounded p-1">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
      </select>
      <span class="ml-2">entries</span>
    </div>
    <div>
      <label for="search" class="mr-2">Search:</label>
      <input id="search" type="text" class="border rounded p-1" />
    </div>
  </div>
  <table class="min-w-full bg-white border">
    <thead>
      <tr class="bg-zinc-200 text-zinc-600 uppercase text-sm leading-normal">
        <th class="py-3 px-6 text-left">Date</th>
        <th class="py-3 px-6 text-left">Item</th>
        <th class="py-3 px-6 text-left">Quantity</th>
        <th class="py-3 px-6 text-left">Group</th>
        <th class="py-3 px-6 text-left">Actions</th>
      </tr>
    </thead>
    <tbody class="text-zinc-600 text-sm font-light">
      <tr class="border-b border-zinc-200 hover:bg-zinc-100">
        <td class="py-3 px-6 text-left">11/6/2024</td>
        <td class="py-3 px-6 text-left">MAIZE GERM</td>
        <td class="py-3 px-6 text-left">100.0</td>
        <td class="py-3 px-6 text-left">MILKER</td>
        <td class="py-3 px-6 text-left">
          <button class="text-zinc-600 hover:text-zinc-900 mr-2">
            <img aria-hidden="true" alt="edit" src="https://placehold.co/16x16" />
          </button>
          <button class="text-red-600 hover:text-red-900">
            <img aria-hidden="true" alt="delete" src="https://placehold.co/16x16" />
          </button>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="flex justify-between items-center mt-4">
    <div>
      <span>Showing 1 to 1 of 1 entries</span>
    </div>
    <div>
      <button class="bg-blue-500 text-white p-2 rounded">1</button>
    </div>
  </div>
</div>
