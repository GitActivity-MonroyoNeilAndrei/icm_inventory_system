


<button id="openImportButton" class="bg-slate-600 hover:bg-slate-700 px-5 py-1 mb-3 rounded text-slate-200 shadow max-sm:text-xs">
  Import Excel
</button>


<div id="import-background" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50 hidden"></div>

<div id="myImport" class="fixed z-30 inset-x-0 top-10 hidden">
  <form action="{{ url('item/import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center bg-white mx-auto w-80 rounded-lg shadow-xl pt-4 pb-1 px-8 border border-gray-700 overflow-y-auto" style="max-height: 80vh;">
    @csrf

    <h1 class="text-2xl font-semibold leading-none">Import Excel</h1>

    <div class="mt-4 w-full">
      <label class="block text-lg font-medium leading-6 text-gray-950">Format:</label>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 1:</span> Name</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 2:</span> Category</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 3:</span> Serial No.</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 4:</span> Model</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 5:</span> Description</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 6:</span> Additional Details</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 7:</span> Status</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 8:</span> Condition</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 9:</span> Location</h5>
      <h5 class="pl-6"><span class="font-bold text-gray-900">Column 10:</span> Date Acquisition</h5>
    </div>

    <div class="mt-6 w-full border border-red">
        <input type="file" name="import_file" class="w-full cursor-pointer">
    </div>

    <div class="py-5 flex gap-4">
      <button type="button" id="closeImport" class="px-3 py-1 bg-red-700 rounded hover:bg-red-800  text-slate-200">Cancel</button>
      <input type="submit" class="px-3 py-1 bg-blue-700 hover:bg-blue-800 rounded text-slate-200 cursor-pointer" value="Import">
    </div>

  </form>
</div>

<script defer>
    document.getElementById('openImportButton').addEventListener('click', function() {
        document.getElementById('myImport').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        document.getElementById('import-background').classList.remove('hidden');
    });

    document.getElementById('closeImport').addEventListener('click', function() {
        document.getElementById('myImport').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        document.getElementById('import-background').classList.add('hidden');
    });
</script>


