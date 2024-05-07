@extends('op.layouts.op_layout')

@section('body')
  @include('op.layouts.navigation')

  <div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">
    <div class="container flex flex-col">

      <div class="pl-1 mb-2 flex items-center">
        <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Dashboard </span>
      </div>
      <h1 class="text-2xl text-slate-950 font-bold mb-3">Dashboard</h1>


      
    </div>
  </div>

@endsection
