@extends('user.layouts.user_layout')

@section('body')

@include('user.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

      <div class="pl-1 mb-2 flex items-center">
        <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Settings </span>
      </div>
      <h1 class="text-2xl font-bold mb-3">Settings</h1>


        
    </div>
</div>

@include('user.popups.user-popup')

@endsection