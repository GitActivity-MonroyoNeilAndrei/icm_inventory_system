@extends('op.layouts.op_layout')

@section('body')

@include('op.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

        @include('op.layouts.items_navigation')


        @foreach($errors->all() as $error)

            <div class="bg-red-700 p-4 text-white">{{ $error }}</div>

        @endforeach
        <div class="w-full  overflow-x-auto border-gray-300">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-gray-500">
                <th class="py-2">Name</th>
                <th class="py-2">Category</th>
                <th class="py-2">Model</th>
                <th class="py-2">Condition</th>
                <th class="py-2">Location</th>
                <th class="py-2">Date Acquisition</th>
                <th class="py-2 w-32">Action</th>
              </tr>
            </thead>
            <tbody>

            @foreach($item as $rs)

              <tr class="border-b border-gray-500 hover:bg-gray-300 {{ $rs->condition == 'condemn' ? 'bg-gray-200' : 'bg-gray-100' }} align-top">
                <td class="py-2 pl-2">{{ $rs->name }}</td>
                <td class="py-2 pl-2 ">{{ $rs->category }}</td>
                <td class="py-2 pl-2">{{ $rs->model }}</td>

                <td class="py-2 pl-2">

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


                  <a class="px-3 py-1 text-sm bg-gray-700 hover:bg-gray-600 shadow rounded-md text-slate-50 {{ $rs->condition == 'condemn' ? 'hidden' : '' }}" href="{{ route('admin.item.edit', $rs->id) }}">Edit</a>


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