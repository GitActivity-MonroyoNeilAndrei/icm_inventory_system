@extends('admin.layouts.admin_layout')

@section('body')

@include('admin.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

      <div class="pl-1 mb-2 flex items-center">
        <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Settings </span>
      </div>
      <h1 class="text-2xl font-bold mb-3">Settings</h1>

      <a class="bg-sky-500 hover:bg-sky-400 py-1 px-2 rounded-md shadow ring-1 text-gray-900" href="">
        Go to option page
      </a>
        
    </div>
</div>

@include('admin.popups.user-popup')

@endsection