@extends('admin.layouts.admin_layout')
 
@section('body')


<div id="create-background" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50"></div>

<div class="fixed z-30 inset-x-0 top-10 flex justify-center items-center x gap-8">
<div id="myCreate" class="">
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
          @if($rs->id == $item->holder)
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




<div id="" class="">
  <form class="flex flex-col items-center bg-white mx-auto shadow-xl pt-4 px-8 border border-gray-700 pb-6 overflow-y-auto" style="max-height: 85vh; max-width: 30rem;">

    <h1 class="text-3xl font-semibold leading-none">Item Details</h1>

  <div class="flex gap-16 max-md:flex-col">
    <div>
      <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Item ID:</label>
          @php
            $date = \Carbon\Carbon::parse($item->date_acquisition);
            $year = substr($date->year, -2);
          @endphp
          @if($item->category == 'IT Equipment')
            <h1 class="text-sm text-left pl-5">{{ '0502' . '-' . $year . '-' . $item->id }}</h2>
          @elseif($item->category == 'Furniture' || $item->category == 'Fixture')
            <h1 class="text-sm text-left pl-5">{{ 'ICM' . '-' . $year . '-'. 'FF' . '-' . $item->id  }}</h2>
          @endif
        </div> 

        <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Name:</label>
          <h1 class="text-sm text-left pl-5">{{ $item->name }}</h2>
        </div>  

        <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Category:</label>
          <h1 class="text-sm text-left pl-5">{{ $item->category }}</h2>
        </div>  

        <div class="mt-2 w-full {{ in_array($item->category, ['Furniture', 'Fixture']) ? 'hidden' : '' }}">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Serial No.:</label>
          <h1 class="text-sm text-left pl-5">{{ $item->serial_no }}</h2>
        </div>  

        <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Model:</label>
          <h1 class="text-sm text-left pl-5">{{ $item->model }}</h2>
        </div>  

        <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Description:</label>
          <h1 class="text-sm text-left pl-5">{{ $item->description }}</h2>
        </div>  
    </div>

    <div>
      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Additional Details:</label>
        <h1 class="text-sm text-left pl-5">{{ $item->additional_details }}</h2>
      </div>  

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Status:</label>
        <h1 class="text-sm text-left pl-5">{{ $item->status }}</h2>
      </div> 

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Location:</label>
        <h1 class="text-sm text-left pl-5">{{ $item->location }}</h2>
      </div>  

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Added by:</label>
        <h1 class="text-sm text-left pl-5">{{ $item->addedByUser->first_name . ' ' . $item->addedByUser->last_name }}</h2>
      </div>  

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Date Acquisition:</label>
        <h1 class="text-sm text-left pl-5">{{ $item->date_acquisition }}</h2>
      </div>  

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Date Added:</label>
        <h1 class="text-sm text-left pl-5">{{ $item->date_added }}</h2>
      </div>  
    </div>
  </div>

  <div class="mt-4 w-full overflow-x-auto border-gray-300">
    <table class="w-full">
      <thead>
        <tr>
          <th>Transaction Date</th>
          <th>Type</th>
          <th>Issued To</th>
        </tr>
      </thead>
      <tbody class="border-b border-gray-500">
        @foreach($transaction as $txn)
          @if($txn->item == $item->id)
          <tr class="border-b border-gray-500">
            <td class="py-2"> {{ $txn->transaction_date }} </td>
            <td class="py-2"> {{ $txn->transaction_status }} </td>
            <td class="py-2"> {{ $txn->IssuedToUser->first_name . ' ' . $txn->IssuedToUser->last_name }} </td>
          </tr>
          @endif
        @endforeach

      </tbody>
    </table>
  </div>

  </form>
</div>
</div>



@endsection