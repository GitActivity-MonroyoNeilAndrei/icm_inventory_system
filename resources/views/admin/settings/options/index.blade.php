@extends('admin.layouts.admin_layout')

@section('body')

@include('admin.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

      <div class="pl-1 mb-2 flex items-center">
        <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Settings > Options </span>
      </div>
      <h1 class="text-2xl font-bold mb-3">Options</h1>

      @include('admin.settings.options.create')

      <div class="border border-gray-700 shadow-lg rounded">
        <div class="grid grid-cols-2 gap-3 p-8">

          <div>
            <div class="bg-blue-400 shadow-xl border py-2 border-gray-400 rounded-xl max-w-96 min-h-24 mx-auto">
              <h1 class="text-center text-xl mb-2 font-semibold">Category</h1>

              @if($category->count() > 0)
                @foreach($category as $rs)
                <div class="flex justify-between py-1 px-4 bg-gray-800/20 border-b border-gray-600">
                  <h1>{{ $rs->name }}</h1>
                  @include('admin.settings.options.destroy')
                </div>
                @endforeach
              @endif

            </div>
          </div>

          <div>
            <div class="bg-blue-400 shadow-xl border py-2 border-gray-400 rounded-xl max-w-96 min-h-24 mx-auto">
              <h1 class="text-center text-xl mb-2xl font-semibold">Center</h1>


              @if($center->count() > 0)
                @foreach($center as $rs)
                <div class="flex justify-between py-1 px-4 bg-gray-800/20 border-b border-gray-600">
                  <h1>{{ $rs->name }}</h1>
                  @include('admin.settings.options.destroy')
                </div>
                @endforeach
              @endif

            </div>
          </div>

          <div>
            <div class="bg-blue-400 shadow-xl border py-2 border-gray-400 rounded-xl max-w-96 min-h-24 mx-auto">
              <h1 class="text-center text-xl mb-2 font-semibold">Position</h1>

              @if($position->count() > 0)
                @foreach($position as $rs)
                <div class="flex justify-between py-1 px-4 bg-gray-800/20 border-b border-gray-600">
                  <h1>{{ $rs->name }}</h1>
                  @include('admin.settings.options.destroy')
                </div>
                @endforeach
              @endif

            </div>
          </div>

          <div>
            <div class="bg-blue-400 shadow-xl border py-2 border-gray-400 rounded-xl max-w-96 min-h-24 mx-auto">
              <h1 class="text-center text-xl mb-2 font-semibold">Department</h1>

              @if($department->count() > 0)
                @foreach($department as $rs)
                <div class="flex justify-between py-1 px-4 bg-gray-800/20 border-b border-gray-600">
                  <h1>{{ $rs->name }}</h1>
                  @include('admin.settings.options.destroy')
                </div>
                @endforeach
              @endif

            </div>
          </div>

        </div>
      </div>



        
    </div>
</div>

@include('admin.popups.user-popup')

@endsection