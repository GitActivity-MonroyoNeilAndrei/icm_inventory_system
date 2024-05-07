<button id="openFilterButton" class="bg-blue-600 hover:bg-blue-500 px-3 py-0.5 rounded text-gray-50 shadow">
  Filter
</button>


<div id="filter-background" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50 hidden"></div>

<div id="myFilter" class="fixed z-30 inset-x-0 top-10 hidden">
  <form action="{{ route('op.report.index') }}" method="GET" class="flex flex-col items-center bg-white mx-auto rounded-lg shadow-xl pt-4 pb-1 px-8  overflow-y-auto" style="max-height: 80vh; max-width: 40rem;">
    @csrf

    <h1 class="text-2xl font-semibold leading-none">Filter Reports</h1>

    <div class="w-full flex max-sm:flex-col sm:mx-auto gap-5 border border-dark">

      <input name="search" type="text" value="{{ $search }}" hidden>

      <div class="min-sm:w-1/2 sm:w-full">
        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Issued To:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" size="6" name="issued_to[]" multiple>
            @foreach($user as $rs)
            <option value="{{ $rs->id }}" {{ in_array($rs->id, $selectedIssuedTo) ? 'selected' : '' }}>{{ $rs->first_name . ' ' . $rs->last_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Issued By:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" size="3" name="issued_by[]" multiple>
            @foreach($user as $rs)
            @if($rs->role == 'admin')
            <option value="{{ $rs->id }}" {{ in_array($rs->id, $selectedIssuedBy) ? 'selected' : '' }}>{{ $rs->first_name . ' ' . $rs->last_name }}</option>
            @endif
            @endforeach
          </select>
        </div>
 
        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Status:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" size="2" name="status[]" multiple>
            <option value="assigned" {{ in_array('assigned', $selectedStatus) ? 'selected' : '' }}>Assigned</option>
            <option value="unassigned" {{ in_array('unassigned', $selectedStatus) ? 'selected' : '' }}>Unassigned</option>
          </select>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Category:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" size="2" name="category[]" multiple>
            @foreach($option as $rs)
            @if($rs->category == 'Category')
            <option value="{{ $rs->name }}">{{ $rs->name }}</option>
            @endif
            @endforeach
          </select>
        </div>

      </div>

      <div class="min-sm:w-1/2 sm:w-full">

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Condition:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="condition[]" size="4" multiple>
            <option value="new" {{ in_array('new', $selectedCondition) ? 'selected' : '' }}>new</option>
            <option value="operational/working" {{ in_array('operational/working', $selectedCondition) ? 'selected' : '' }}>operational/working</option>
            <option value="condemn" {{ in_array('condemn', $selectedCondition) ? 'selected' : '' }}>condemn</option>
            <option value="for repair" {{ in_array('for repair', $selectedCondition) ? 'selected' : '' }}>for repair</option>
          </select>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Location:</label>
          <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" size="2" name="location[]" multiple>
            @foreach($option as $rs)
            @if($rs->category == 'Department')
            <option value="{{ $rs->name }}">{{ $rs->name }}</option>
            @endif
            @endforeach
          </select>
        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Date Assigned:</label>

          <div class="flex">
            <input type="date" name="added_date_start" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" value="{{ $addedDateStart }}">

            <input type="date" name="added_date_end" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" value="{{ $addedDateEnd }}">
          </div>

        </div>

        <div class="mt-2 w-full">
          <label class="block text-sm font-medium leading-6 text-gray-900">Date Acquired:</label>

          <div class="flex">
            <input type="date" name="acquired_date_start" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" value="{{ $acquiredDateStart }}">

            <input type="date" name="acquired_date_end" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" value="{{ $acquiredDateEnd }}">
          </div>

        </div>


      </div>
    </div>


    <div class="py-5 flex gap-4">
      <button type="button" id="closeFilter" class="px-3 py-1 bg-red-700 hover:bg-red-600 rounded  text-slate-100">Close</button>
      <input type="submit" class="px-3 py-1 bg-blue-700 hover:bg-blue-600 rounded text-slate-200 cursor-pointer" value="Apply">
      <button type="button" id="resetFilter" class="px-3 py-1 bg-green-700 hover:bg-green-600 rounded text-slate-200">Reset</button>
    </div>

  </form>
</div>

<script defer>
  document.getElementById('openFilterButton').addEventListener('click', function() {
    document.getElementById('myFilter').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    document.getElementById('filter-background').classList.remove('hidden');
  });

  document.getElementById('closeFilter').addEventListener('click', function() {
    document.getElementById('myFilter').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    document.getElementById('filter-background').classList.add('hidden');
  });

  document.getElementById('resetFilter').addEventListener('click', function() {
    document.querySelectorAll('select').forEach(function(select) {
      select.querySelectorAll('option').forEach(function(option) {
        option.selected = false;
      });
    });

  });
</script>