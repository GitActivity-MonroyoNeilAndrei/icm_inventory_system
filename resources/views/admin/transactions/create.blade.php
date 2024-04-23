@extends('admin.layouts.admin_layout')
 
@section('body')


<div id="create-background" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50"></div>

<div id="myCreate" class="fixed z-30 inset-x-0 top-10">
  <form action="{{ route('transaction.store.txn', $item->id ) }}" method="POST" class="flex flex-col items-center bg-white mx-auto w-80 rounded-lg shadow-xl pt-4 pb-1 px-8 border border-gray-700 overflow-y-auto" style="max-height: 80vh;">
    @csrf

    <h1 class="text-2xl font-semibold leading-none">Add Transaction</h1>

    

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Transaction Type:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2 bg-gray-300" name="status" required>
        <option value="{{ $item->status == 'assigned' ? 'unassigned' : 'assigned' }}">{{ $item->status == 'assigned' ? 'returned' : 'assigned' }}</option>
      </select>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Issued To:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="issued_to" required>

    
      @if($item->status == 'assigned')
        @foreach($user as $rs)
          @if($rs->id == $item->id)
          <option value="{{ $rs->id }}">{{ $rs->first_name . ' ' . $rs->last_name }}</option>
          @endif
        @endforeach
      @else
        @foreach($user as $rs)
          @if($rs->status != 'deleted')
            <option value="{{ $rs->id }}">{{ $rs->first_name . ' ' . $rs->last_name }}</option>
          @endif
        @endforeach
      @endif
      </select>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Issued By:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2 bg-gray-300" name="issued_by" required>

          <option value="{{ auth()->user()->id }}">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</option>

      </select>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Item:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2 bg-gray-300" name="item" required>

        <option value="{{ $item->id }}">{{ $item->name }}</option>

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


    <div class="py-5 flex gap-4">
      <a class="px-3 py-1 bg-red-700 rounded  text-slate-200" href="{{ route('admin.item.index') }}">Cancel</a>
      <input type="submit" class="px-3 py-1 bg-blue-700 rounded text-slate-200 cursor-pointer" value="Add">
    </div>

  </form>
</div>

@endsection