<button id="openCreateButton" class="bg-green-600 hover:bg-green-700 px-4 py-0.5 mb-3 rounded text-md text-slate-200 shadow col-span-2 mx-auto">
  Add Option
</button>


<div id="create-background" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50 hidden"></div>

<div id="myCreate" class="fixed z-30 inset-x-0 top-10 hidden">
  <form action="{{ route('option.store') }}" method="post" class="flex flex-col items-center bg-white mx-auto w-80 rounded-lg shadow-xl pt-4 pb-1 px-8 border border-gray-700 overflow-y-auto" style="max-height: 80vh;">
    @csrf

    <h1 class="text-2xl font-semibold leading-none">Add Option</h1>


    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Name:</label>
      <input name="name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Options:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="category" required>
        <option value="Category">Category</option>
        <option value="Position">Position</option>
        <option value="Department">Department</option>
        <option value="Center">Center</option>

      </select>
    </div>


    <div class="py-5 flex gap-4">
      <button type="button" id="closeCreate" class="px-3 py-1 bg-red-700 rounded  text-slate-200">Cancel</button>
      <input type="submit" class="px-3 py-1 bg-blue-700 rounded text-slate-200 cursor-pointer" value="Add">
    </div>

  </form>
</div>

<script defer>
    document.getElementById('openCreateButton').addEventListener('click', function() {
        document.getElementById('myCreate').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        document.getElementById('create-background').classList.remove('hidden');
    });

    document.getElementById('closeCreate').addEventListener('click', function() {
        document.getElementById('myCreate').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        document.getElementById('create-background').classList.add('hidden');
    });
</script>














