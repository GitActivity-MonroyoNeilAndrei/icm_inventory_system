<button id="openShowButton{{ $loop->iteration }}" class="px-3 py-1 text-sm bg-green-700 hover:bg-green-600 shadow rounded-md text-slate-50">
  View
</button>


<div id="show-background{{ $loop->iteration }}" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50 hidden"></div>

<div id="myShow{{ $loop->iteration }}" class="fixed z-30 inset-x-0 top-10 hidden">
  <form class="flex flex-col items-center bg-white mx-auto shadow-xl pt-4 px-8 border border-gray-700 pb-6 overflow-y-auto" style="max-height: 85vh; max-width: 30rem;">

    <h1 class="text-3xl font-semibold leading-none">Item Details</h1>

    {!! App\Helpers\Barcode::generateBarcode($rs->id) !!}

  <div class="flex gap-16 max-md:flex-col">
    <div>
      <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Item ID:</label>
          @php
            $date = \Carbon\Carbon::parse($rs->date_acquisition);
            $year = substr($date->year, -2);
          @endphp
          @if($rs->category == 'IT Equipment')
            <h1 class="text-sm text-left pl-5">{{ '0502' . '-' . $year . '-' . $rs->id }}</h2>
          @elseif($rs->category == 'Furniture' || $rs->category == 'Fixture')
            <h1 class="text-sm text-left pl-5">{{ 'ICM' . '-' . $year . '-'. 'FF' . '-' . $rs->id  }}</h2>
          @endif
        </div> 

        <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Name:</label>
          <h1 class="text-sm text-left pl-5">{{ $rs->name }}</h2>
        </div>  

        <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Category:</label>
          <h1 class="text-sm text-left pl-5">{{ $rs->category }}</h2>
        </div>  

        <div class="mt-2 w-full {{ in_array($rs->category, ['Furniture', 'Fixture']) ? 'hidden' : '' }}">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Serial No.:</label>
          <h1 class="text-sm text-left pl-5">{{ $rs->serial_no }}</h2>
        </div>  

        <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Model:</label>
          <h1 class="text-sm text-left pl-5">{{ $rs->model }}</h2>
        </div>  

        <div class="mt-2 w-full">
          <label class="block text-md font-bold text-left leading-6 text-gray-900">Description:</label>
          <h1 class="text-sm text-left pl-5">{{ $rs->description }}</h2>
        </div>  
    </div>

    <div>
      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Additional Details:</label>
        <h1 class="text-sm text-left pl-5">{{ $rs->additional_details }}</h2>
      </div>  

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Status:</label>
        <h1 class="text-sm text-left pl-5">{{ $rs->status }}</h2>
      </div> 

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Location:</label>
        <h1 class="text-sm text-left pl-5">{{ $rs->location }}</h2>
      </div>  

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Added by:</label>
        <h1 class="text-sm text-left pl-5">{{ $rs->addedByUser->first_name . ' ' . $rs->addedByUser->last_name }}</h2>
      </div>  

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Date Acquisition:</label>
        <h1 class="text-sm text-left pl-5">{{ $rs->date_acquisition }}</h2>
      </div>  

      <div class="mt-2 w-full">
        <label class="block text-md font-bold text-left leading-6 text-gray-900">Date Added:</label>
        <h1 class="text-sm text-left pl-5">{{ $rs->date_added }}</h2>
      </div>  
    </div>
  </div>

  <div class="mt-4 w-full overflow-x-auto border-gray-300">
    <table class="w-full">
      <thead>
        <tr>
          <th>Transaction Date</th>
          <th>Status</th>
          <th>Issued To</th>
        </tr>
      </thead>
      <tbody class="border-b border-gray-500">
        @foreach($transaction as $txn)
          @if($txn->item == $rs->id)
          <tr class="border-b border-gray-500">
            <td class="py-2"> {{ $txn->transaction_date }} </td>
            <td class="py-2"> {{ $txn->status }} </td>
            <td class="py-2"> {{ $txn->IssuedToUser->first_name . ' ' . $txn->IssuedToUser->last_name }} </td>
          </tr>
          @endif
        @endforeach

      </tbody>
    </table>
  </div>





    <div class="py-5 flex gap-4 sticky bottom-0">
      <button type="button" id="closeShow{{ $loop->iteration }}" class="px-3 py-0.5 bg-red-700 rounded  text-slate-200">Close</button>
    </div>

  </form>
</div>

<script defer>
    document.getElementById('openShowButton{{ $loop->iteration }}').addEventListener('click', function() {
        document.getElementById('myShow{{ $loop->iteration }}').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        document.getElementById('show-background{{ $loop->iteration }}').classList.remove('hidden');
    });

    document.getElementById('closeShow{{ $loop->iteration }}').addEventListener('click', function() {
        document.getElementById('myShow{{ $loop->iteration }}').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        document.getElementById('show-background{{ $loop->iteration }}').classList.add('hidden');
    });
</script>




