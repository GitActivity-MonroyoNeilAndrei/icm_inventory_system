<form action="{{ route('admin.report.exportCSV') }}" method="GET">
    @csrf

    <input name="search" type="text" value="{{ $search }}" hidden>

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



    <input type="submit" class="bg-blue-700 text-gray-50 px-3 py-0.5 rounded hover:cursor-pointer hover:bg-blue-800" value="Export">


  </form>