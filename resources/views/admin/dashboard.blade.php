@extends('admin.layouts.admin_layout')


@section('body')
@include('admin.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

  <div class="container flex flex-col">

    <div class="pl-1 mb-2 flex items-center">
      <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Dashboard </span>
    </div>
    <h1 class="text-2xl text-slate-950 font-bold mb-3">Dashboard</h1>

    <div class="shadow font-bold cursor-pointer hover:opacity-80 bg-cyan-500 max-h-32 rounded-xl px-4 p-3 flex max-w-60">
      DASHBOARD
      <img class="ml-3 size-24" src="{{ asset('images/dashboard-logo-2.png') }}" alt="">
    </div>

  </div>
</div>

@endsection
