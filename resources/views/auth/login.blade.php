@extends('admin.layouts.admin_layout')


@section('body')
<div id="create-background" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50"></div>

<div id="myCreate" class="fixed z-30 inset-x-0 top-10">
  <form action="{{ route('login') }}" method="POST" class="flex flex-col items-center bg-white mx-auto w-80 rounded-lg shadow-xl pt-4 pb-1 px-8 border border-gray-700 overflow-y-auto" style="max-height: 80vh;">
    @csrf

    <h1 class="text-3xl font-bold leading-none">LOGIN</h1>

    @if(Session::has('deactivated'))
    <div class="w-full p-3 mt-3 rounded shadow text-white font-semibold bg-red-600">
      <span>
        {{ Session::get('deactivated') }}
      </span>
    </div>
    @elseif(Session::has('fail'))
    <div class="w-full p-3 mt-3 rounded shadow text-white font-semibold bg-red-600">
      <span>
        {{ Session::get('fail') }}
      </span>
    </div>
    @endif

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Email:</label>
      <input name="email" type="email" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Password:</label>
      <input name="password" type="password" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
    </div>

    <div class="py-5 flex flex-col gap-3">
      <input type="submit" class="px-3 py-1 bg-blue-700 hover:bg-blue-800 rounded text-slate-200 cursor-pointer" value="Log-in">

      <a class="text-sm underline text-blue-800" href="">Register here</a>
    </div>

  </form>
</div>

@include('admin.popups.login-popup')

@endsection