
<form action="{{ route('op.transaction.index') }}" method="get" class="max-w-lg shadow">
    @csrf
    <select name="issued_to[]" multiple hidden>
      @foreach($user as $rs)
        <option value="{{ $rs->id }}" {{ in_array($rs->id, $selectedIssuedTo) ? 'selected' : '' }}>{{ $rs->first_name . ' ' . $rs->last_name }}</option>
      @endforeach
    </select>


    <select name="issued_by[]" multiple hidden>
      @foreach($user as $rs)
        @if($rs->role == 'admin')
          <option value="{{ $rs->id }}" {{ in_array($rs->id, $selectedIssuedBy) ? 'selected' : '' }}>{{ $rs->first_name . ' ' . $rs->last_name }}</option>
        @endif
      @endforeach
    </select>


  <select name="status[]" multiple hidden>
    <option value="assigned" {{ in_array('assigned', $selectedStatus) ? 'selected' : '' }}>Assigned</option>
    <option value="unassigned" {{ in_array('unassigned', $selectedStatus) ? 'selected' : '' }}>Unassigned</option>
  </select>



    <select name="item[]" size="6" multiple hidden>
      @foreach($item as $rs)
        <option value="{{ $rs->id }}" {{ in_array($rs->id, $selectedItem) ? 'selected' : '' }}>{{ $rs->name }}</option>
      @endforeach
    </select>


    <select name="condition[]" size="4" multiple hidden>
      <option value="new" {{ in_array('new', $selectedCondition) ? 'selected' : '' }}>new</option>
      <option value="operational/working" {{ in_array('operational/working', $selectedCondition) ? 'selected' : '' }}>operational/working</option>
      <option value="condemn" {{ in_array('condemn', $selectedCondition) ? 'selected' : '' }}>condemn</option>
      <option value="for repair" {{ in_array('for repair', $selectedCondition) ? 'selected' : '' }}>for repair</option>
    </select>


    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input name="search" type="text" id="default-search" class="block w-full py-2 px-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500  focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Transaction" value="{{ $search }}">
        <button type="submit" class="text-white absolute end-2.5 inset-y-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>
