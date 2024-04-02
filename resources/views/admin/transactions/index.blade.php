@extends('admin.layouts.admin_layout')

@section('body')

@include('admin.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

        <div class="pl-1 mb-2 flex items-center">
          <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Transaction </span>
        </div>
        <h1 class="text-2xl font-bold mb-3">All Transactions</h1>

        <div class="flex justify-between">
          @include('admin.transactions.create')

          @include('admin.transactions.search-transaction')
        </div>

        @foreach($errors->all() as $error)

            <div class="bg-red-700 p-4">{{ $error }}</div>

        @endforeach
        <div class="w-full  overflow-x-auto border-gray-300">
          <table class="w-full">
            <thead>
              <tr class="border-b border-gray-500">
              <th class="py-2">Date of Transaction</th>
                <th class="py-2">Issued To</th>
                <th class="py-2">Issued By</th>
                <th class="py-2">Transaction Type</th>
                <th class="py-2">Item</th>
                <th class="py-2">Status</th>

                <th class="py-2 w-20">Action</th>
              </tr>
            </thead>
            <tbody>

            @foreach($transaction as $rs)

              <tr class="border-b border-gray-500 bg-gray-100 hover:bg-gray-200">
              <td class="py-2 pl-2">{{ $rs->created_at }}</td>
                <td class="py-2 pl-2">{{ $rs->IssuedToUser->first_name . ' ' . $rs->IssuedToUser->last_name }}</td>
                <td class="py-2 pl-2">{{ $rs->IssuedByUser->first_name . ' ' . $rs->IssuedByUser->last_name }}</td>
                <td class="py-2 pl-2">{{ $rs->transaction_type }}</td>
                <td class="py-2 pl-2">{{ $rs->Item->name }}</td>
                <td class="py-2 pl-2">{{ $rs->status }}</td>

                <td class="py-2 text-center w-20">
                  


                  <a class="px-3 py-1 text-sm bg-gray-700 hover:bg-gray-600 shadow rounded-md text-slate-50" href="{{ route('transaction.edit', $rs->id) }}">Edit</a>

                </td>
              </tr>

              @endforeach
              
            </tbody>
          </table>
          <div class="mt-4">

            {{ $transaction->links() }}

          </div>
        </div>











    </div>
</div>

@include('admin.popups.user-popup')

@endsection