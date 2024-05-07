@extends('op.layouts.op_layout')

@section('body')

@include('op.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

  <div class="container mx-auto">

    <div class="pl-1 mb-2 flex items-center">
      <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Transaction </span>
    </div>
    <h1 class="text-2xl font-bold mb-3">All Reports</h1>

    <div class="flex justify-between">

      <div class="flex items-center gap-3">
        @include('admin.reports.search-transaction')

        @include('admin.reports.filter')
      </div>


      @include('admin.reports.export-csv')
    </div>


    @foreach($errors->all() as $error)

    <div class="bg-red-700 p-4">{{ $error }}</div>

    @endforeach
    <div class="w-full  overflow-x-auto border-gray-300">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-500">
            <th class="py-2">Date of Transaction</th>
            <th class="py-2">Issued To</th>
            <th class="py-2">Issued By</th>
            <th class="py-2">Item</th>
            <th class="py-2">Category</th>
            <th class="py-2">Serial No</th>
            <th class="py-2">Model</th>
            <th class="py-2">Description</th>
            <th class="py-2">Additional Details</th>
            <th class="py-2">Status</th>
            <th class="py-2">Condition</th>
            <th class="py-2">Location</th>
            
          </tr>
        </thead>
        <tbody>

          @foreach($transaction as $rs)

          <tr class="border-b border-gray-500 bg-gray-100 hover:bg-gray-200 align-top">
            <td class="py-2 pl-2">{{ $rs->transaction_date }}</td>
            <td class="py-2 pl-2">{{ $rs->IssuedToUser->first_name . ' ' . $rs->IssuedToUser->last_name }}</td>
            <td class="py-2 pl-2">{{ $rs->IssuedByUser->first_name . ' ' . $rs->IssuedByUser->last_name }}</td>
            <td class="py-2 pl-2">{{ $rs->Item->name }}</td>
            <td class="py-2 pl-2">{{ $rs->Item->category }}</td>
            <td class="py-2 pl-2">{{ $rs->Item->serial_no }}</td>
            <td class="py-2 pl-2">{{ $rs->Item->model }}</td>
            <td class="py-2 pl-2" style="min-width: 20rem;">{{ $rs->Item->description }}</td>
            <td class="py-2 pl-2" style="min-width: 20rem;">{{ $rs->Item->additional_details }}</td>

            <td class="py-2 pl-2 truncate"><span class="px-3 pt-0.5 pb-1 rounded-md text-sm
            @if($rs->transaction_status == 'assigned')
              {{ 'bg-yellow-300/80 text-gray-800 font-semibold' }}
            @elseif($rs->transaction_status == 'unassigned')
              {{ 'bg-violet-800/80 text-gray-100' }}
            @endif">{{ $rs->transaction_status }}</span></td>
            <td class="py-2 pl-2 truncate">
              <span class="text-gray-900 text-sm">
                    
                <div class="inline-block size-3 me-1 rounded-full
                  @if($rs->condition == 'new')
                    {{ 'bg-green-700/80' }}
                  @elseif($rs->condition == 'operational/working')
                    {{ 'bg-blue-700/80' }}
                  @elseif($rs->condition == 'condemn')
                    {{ 'bg-red-700/90' }}
                  @elseif($rs->condition == 'for repair')
                    {{ 'bg-orange-700/80' }}
                  @endif
                "></div>

                {{ $rs->condition }}</span>
            </td>
            <td class="py-2 pl-2">{{ $rs->Item->location }}</td>


          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
    <div class="mt-4">

      {{ $transaction->links() }}

    </div>

  </div>
</div>

@include('admin.popups.user-popup')

@endsection