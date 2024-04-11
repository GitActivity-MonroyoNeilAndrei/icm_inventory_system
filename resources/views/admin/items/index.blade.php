@extends('admin.layouts.admin_layout')

@section('body')

@include('admin.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

        <div class="pl-1 mb-2 flex items-center">
          <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Items </span>
        </div>
        <h1 class="text-2xl font-bold mb-3">All Items</h1>

        <div class="flex justify-between">
          <div>
            @include('admin.items.create')
            <a href="{{ route('item.scan') }}" class="bg-indigo-700 hover:bg-indigo-600 px-5 py-1 mb-3 rounded text-slate-200 shadow">Scan</a>
          </div>

          @include('admin.items.search-item')

          @include('admin.items.import-excel')
        </div>

        @foreach($errors->all() as $error)

            <div class="bg-red-700 p-4">{{ $error }}</div>

        @endforeach
        <div class="w-full  overflow-x-auto border-gray-300">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-gray-500">
                <th class="py-2">Name</th>
                <th class="py-2">Category</th>
                <th class="py-2">Model</th>
                <th class="py-2">Status</th>
                <th class="py-2">Condition</th>
                <th class="py-2">Date Acquisition</th>

                <th class="py-2 w-32">Action</th>
                <th class="py-2 w-24">Transaction</th>
              </tr>
            </thead>
            <tbody>


            @foreach($item as $rs)

              <tr class="border-b border-gray-500 hover:bg-gray-300 {{ $rs->condition == 'condemn' ? 'bg-gray-200' : 'bg-gray-100' }}">
                <td class="py-2 pl-2">{{ $rs->name }}</td>
                <td class="py-2 pl-2 ">{{ $rs->category }}</td>
                <td class="py-2 pl-2">{{ $rs->model }}</td>
                <td class="py-2 pl-2"><span class="px-3 pt-0.5 pb-1 rounded-md text-gray-50 text-sm
                  @if($rs->status == 'assigned')
                    {{ 'bg-yellow-300/80 text-gray-800 font-semibold' }}
                  @elseif($rs->status == 'unassigned')
                    {{ 'bg-violet-800/80' }}
                  @endif
                ">{{ $rs->status == 'assigned' ? 'assigned' : 'available' }}</span></td>
                <td class="py-2 pl-2"><span class="px-3 pt-0.5 pb-1 rounded-md text-gray-50 text-sm
                  @if($rs->condition == 'new')
                    {{ 'bg-green-700/80' }}
                  @elseif($rs->condition == 'operational/working')
                    {{ 'bg-blue-700/80' }}
                  @elseif($rs->condition == 'condemn')
                    {{ 'bg-red-700/90' }}
                  @elseif($rs->condition == 'for repair')
                    {{ 'bg-orange-700/80' }}
                  @endif

                ">{{ $rs->condition }}</span></td>
                <td class="py-2 pl-2">{{ $rs->date_acquisition }}</td>

                <td class="py-2 text-center w-32">
                  
                  @include('admin.items.show')

                  <a class="px-3 py-1 text-sm bg-gray-700 hover:bg-gray-600 shadow rounded-md text-slate-50" href="{{ route('admin.item.edit', $rs->id) }}">Edit</a>

                </td>
                <td class="py-2 text-center w-24">
                  @if($rs->condition == 'condemn')
                    <a class="px-6 py-1 text-sm bg-red-700/90 shadow rounded-md text-slate-50 cursor-not-allowed" href="">Add</a>
                  @else
                    <a class="px-6 py-1 text-sm bg-blue-700 hover:bg-blue-600 shadow rounded-md text-slate-50" href="{{ route('transaction.add', $rs->id) }}">Add</a>
                  @endif
                </td>
              </tr>

              @endforeach
              
            </tbody>
          </table>
          <div class="mt-4">

            {{ $item->links() }}

          </div>
        </div>











    </div>
</div>

@include('admin.popups.user-popup')

@endsection