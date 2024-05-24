<button id="openCreateButton" class="bg-blue-600 hover:bg-blue-500 px-5 py-1 mb-3 rounded text-slate-200 shadow max-sm:text-xs">
  Add Item
</button>


<div id="create-background" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50 hidden"></div>

<div id="myCreate" class="fixed z-30 inset-x-0 top-10 hidden">
  <form action="{{ route('admin.item.store' ) }}" method="POST" class="flex flex-col items-center bg-white mx-auto rounded-lg shadow-xl pt-4 pb-1  border border-gray-700 overflow-y-auto" style="max-height: 80vh; max-width: 40rem;">
    @csrf

    <h1 class="text-2xl font-semibold leading-none">Add Item</h1>

    <div class="flex gap-5 max-sm:flex-col">

      <div class="w-72 ">

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Name:</label>
          <input name="name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Category:</label>
          <select id="category" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="category" required>
            @foreach($category as $rs)
              @if($rs->status == 'enable')
                <option value="{{ $rs->name }}">{{ $rs->name }}</option>
              @endif
            @endforeach
          </select>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Serial No:</label>
          <input id="serial_no" name="serial_no" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Model:</label>
          <input name="model" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Description:</label>
          <input name="description" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600">
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Location:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="location" required>
            @foreach($department as $rs)
              @if($rs->status == 'enable')
                <option value="{{ $rs->name }}">{{ $rs->name }}</option>
              @endif
            @endforeach
          </select>
        </div>

      </div>

      <div class="w-72 ">

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Additional Details:</label>
          <textarea name="additional_details" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" rows="4"></textarea>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Status:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="status" required>
            <!-- <option value="assigned">Assigned</option> -->
            <option value="unassigned">Unassigned</option>
          </select>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Condition:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="condition" required>
            <option value="new">new</option>
            <option value="operational/working">operational/working</option>
            <option value="condemn">condemn</option>
            <option value="for repair">for repair</option>
          </select>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Date of Acquisition:</label>
          <input name="date_acquisition" type="date" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
        </div>

      </div>

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

  var categorySelect = document.getElementById('category');
    // Get the serial no input element
    var serialNoInput = document.getElementById('serial_no');

    // Add event listener to category select
    categorySelect.addEventListener('change', function() {
        // If Furniture is selected, disable the serial no input
        if (categorySelect.value === 'Furniture' || categorySelect.value === 'Fixture') {
            serialNoInput.disabled = true;
            serialNoInput.style.backgroundColor = '#dddddd';
        } else {
            serialNoInput.disabled = false;
        }
    });
</script>