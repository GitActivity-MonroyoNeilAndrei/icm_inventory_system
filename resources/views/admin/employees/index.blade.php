@extends('admin.layouts.admin_layout')

@section('body')

@include('admin.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

        <div class="pl-1 mb-2 flex items-center">
          <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Employees </span>
        </div>
        <h1 class="text-2xl font-bold mb-3">All Employees</h1>

        <div class="flex items-center justify-between max-sm:flex-col max-sm:space-y-2">
          @include('admin.employees.create')

          @include('admin.employees.search-user')
        </div>


        <div class="w-full  overflow-x-auto border-gray-300">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-gray-500">
                <th class="py-2">First Name</th>
                <th class="py-2">Last Name</th>
                <th class="py-2">Position</th>
                <th class="py-2">Department</th>  
                <th class="py-2">Campus</th>
                <th class="py-2 w-44">Actions</th>
              </tr>
            </thead>
            <tbody>

            @if($user->count() > 0)
              @foreach($user as $rs)
                @if($rs->status != 'deleted')

                  <tr class="border-b border-gray-500 bg-gray-100 hover:bg-gray-200 align-top">
                    <td class="py-2 pl-2">{{ $rs->first_name }}</td>
                    <td class="py-2 pl-2">{{ $rs->last_name }}</td>
                    <td class="py-2 pl-2">{{ $rs->position }}</td>
                    <td class="py-2 pl-2">{{ $rs->department }}</td>
                    <td class="py-2 pl-2">{{ $rs->campus }}</td>
                    <td class="py-2 text-center w-44">
                      <a class="px-3 py-1 text-sm bg-gray-700 hover:bg-gray-600 shadow rounded-md text-slate-50" href="{{ route('employee.edit', $rs->id) }}">Edit</a>

                      @include('admin.employees.change-status')

                    </td>
                  </tr>
                 @endif
                @endforeach
              @else
              <tr>
                <td colspan="7" class="text-center text-2xl text-gray-950 font-bold border-b border-gray-400">No Data Found</td>
              </tr>
              @endif
              
            </tbody>
          </table>
        </div>
        <div class="mt-4">

        {{ $user->links() }}

        </div>
    </div>
</div>



@include('admin.popups.user-popup')

@endsection