@extends('admin.layouts.admin_layout')
 
@section('body')


<div id="modal-background" class="fixed top-0 left-0 z-20 w-full h-full bg-gray-700/80">

</div>

<div id="myModal" class="fixed z-30 inset-x-0 top-10">
    <form action="{{ route('transaction.update', $transaction->id) }}" method="post" class="flex items-center justify-center">
      @csrf
      @method('PUT')
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 overflow-y-auto" style="max-height: 85vh;">

      <h1 class="font-bold text-2xl text-center text-neutral-800">Edit Transaction</h1>

      <div class="mt-2 w-full">
        <label class="block text-sm font-medium leading-6 text-gray-900">Transaction Type:</label>
        <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="status" required>
          <option value="assigned" {{ 'assigned' == $transaction->status ? 'selected' : '' }}>assigned</option>
          <option value="unassigned" {{ 'unassigned' == $transaction->status ? 'selected' : '' }}>unassigned</option>
        </select>
      </div>

      <div class="mt-2 w-full">
        <label class="block text-sm font-medium leading-6 text-gray-900">Issued To:</label>
        <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="issued_to" required>
        @foreach($user as $rs)
            @if($rs->role != 'admin')
            <option value="{{ $rs->id }}" {{ $rs->id == $transaction->issued_to ? 'selected' : '' }}>{{ $rs->first_name . ' ' . $rs->last_name }}</option>
            @endif
          @endforeach
        </select>
      </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Issued By:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="issued_by" required>

          <option value="{{ auth()->user()->id }}">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</option>

      </select>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Item:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="item" required>
        @foreach($item as $rs)
          <option value="{{ $rs->id }}" {{ $rs->id == $transaction->item ? 'selected' : '' }}>{{ $rs->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Condition:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="condition" required>
          <option value="new" {{ $transaction->condition == 'new' ? 'selected' : '' }}>new</option>
          <option value="operational/working" {{ $transaction->condition == 'operational/working' ? 'selected' : '' }}>operational/working</option>
          <option value="condemn" {{ $transaction->condition == 'condemn' ? 'selected' : '' }}>condemn</option>
          <option value="for repair" {{ $transaction->condition == 'for repair' ? 'selected' : '' }}>for repair</option>
      </select>
    </div>

            <div class="py-5 flex justify-center gap-4">
                <a class="px-3 py-1 bg-red-700 rounded  text-slate-200" href="{{ route('transaction.index') }}">Cancel</a>
                <input type="submit" class="px-3 py-1 bg-blue-700 rounded text-slate-200 cursor-pointer" value="Save">
            </div>
        </div>
    </form>
</div>

@endsection