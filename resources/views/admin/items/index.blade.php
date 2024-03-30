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
          @include('admin.items.create')

          @include('admin.items.import-excel')
        </div>


        <div class="w-full  overflow-x-auto border-gray-300">
          <table class="w-full">
            <thead>
              <tr class="border-b border-gray-500">
                <th class="py-2">Item ID</th>
                <th class="py-2">Name</th>
                <th class="py-2">Category</th>
                <th class="py-2">Model</th>
                <th class="py-2">Description</th>
                <th class="py-2">Status</th>
                <th class="py-2">Date Acquisition</th>

                <th class="py-2 w-44">Action</th>
              </tr>
            </thead>
            <tbody>


            @foreach($item as $rs)

              <tr class="border-b border-gray-500 bg-gray-100 hover:bg-gray-200">
                <td class="py-2 pl-2">{{ $rs->id }}</td>
                <td class="py-2 pl-2">{{ $rs->name }}</td>
                <td class="py-2 pl-2">{{ $rs->category }}</td>
                <td class="py-2 pl-2">{{ $rs->model }}</td>
                <td class="py-2 pl-2">{{ $rs->description }}</td>
                <td class="py-2 pl-2">{{ $rs->status }}</td>
                <td class="py-2 pl-2">{{ $rs->date_acquisition }}</td>

                <td class="py-2 text-center w-44">
                  
                  @include('admin.items.show')

                  <a class="px-3 py-1 text-sm bg-gray-700 hover:bg-gray-600 shadow rounded-md text-slate-50" href="{{ route('admin.item.edit', $rs->id) }}">Edit</a>

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