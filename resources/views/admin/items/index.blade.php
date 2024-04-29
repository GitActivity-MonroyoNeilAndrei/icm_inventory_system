@extends('admin.layouts.admin_layout')

@section('body')

@include('admin.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

        @include('admin.layouts.items_navigation')

        @foreach($errors->all() as $error)
            <div class="bg-red-700 p-4 text-white">{{ $error }}</div>
        @endforeach
        

        @if(Session::has('errorColumnCount'))
          <div class="bg-red-700 p-4 text-white">{{ Session::get('errorColumnCount') }}</div>
        @elseif(Session::has('errorStatus'))
          <div class="bg-red-700 p-4 text-white">{{ Session::get('errorStatus') }}</div>
        @elseif(Session::has('errorCondition'))
          <div class="bg-red-700 p-4 text-white">{{ Session::get('errorCondition') }}</div>
        @endif

        <div class="w-full  overflow-x-auto border-gray-300">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-gray-500">
                <th class="py-2">Name</th>
                <th class="py-2">Category</th>
                <th class="py-2">Model</th>
                <th class="py-2">Status</th>
                <th class="py-2">Condition</th>
                <th class="py-2">Location</th>
                <th class="py-2">Date Acquisition</th>
                <th class="py-2 w-32">Action</th>
                <th class="py-2 w-24">Transaction</th>
              </tr>
            </thead>
            <tbody>

            @foreach($item as $rs)

              <tr class="border-b border-gray-500 hover:bg-gray-300 {{ $rs->condition == 'condemn' ? 'bg-gray-200' : 'bg-gray-100' }} align-top">
                <td class="py-2 pl-2">{{ $rs->name }}</td>
                <td class="py-2 pl-2 ">{{ $rs->category }}</td>
                <td class="py-2 pl-2">{{ $rs->model }}</td>
                <td class="py-2 pl-2">

                  @if($rs->status == 'assigned')
                    <span class="px-3 pt-0.5 pb-1 rounded-md text-sm bg-yellow-300/50 text-gray-800 font-semibold">  assigned </span>
                  @elseif($rs->status == 'unassigned')
                    <span class="px-3 pt-0.5 pb-1 rounded-md text-sm font-semibold bg-violet-800/50 text-gray-200"> available </span>
                  @endif
                
                </td>
                <td class="py-2 pl-2 ">
                  
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

                <td class="py-2 pl-2"> {{ $rs->location }} </td>
                <td class="py-2 pl-2">{{ $rs->date_acquisition }}</td>

                <td class="py-2 text-center w-32">

                  @include('admin.items.show')

                  <a class="px-3 py-1 text-sm bg-gray-700 hover:bg-gray-600 shadow rounded-md text-slate-50" href="{{ route('admin.item.edit', $rs->id) }}">Edit</a>

                </td>
                <td class="py-3 text-center w-24">
                  @if($rs->condition == 'condemn')
                    <p class="inline px-6 py-1 text-sm bg-red-700/90 shadow rounded-md text-slate-50 cursor-not-allowed" href="">Add</p>
                  @else
                    <a class="px-6 py-1 text-sm bg-blue-700 hover:bg-blue-600 shadow rounded-md text-slate-50" href="{{ route('transaction.add', $rs->id) }}">Add</a>
                  @endif
                </td>
              </tr>

              @endforeach
              
            </tbody>
          </table>
        </div>
        <div class="mt-4">

        {{ $item->links() }}

        </div>
    </div>
</div>

@include('admin.popups.user-popup')

@endsection