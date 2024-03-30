@extends('admin.layouts.admin_layout')

@section('body')

@include('admin.layouts.navigation')

<div class="h-screen pt-3 flex flex-no-wrap px-5 sm:ml-52 max-sm:ml-0">

    <div class="container mx-auto">

      <div class="pl-1 mb-2 flex items-center justify-between">
        <div class="flex">
          <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Settings </span>
        </div>

        @include('admin.settings.logout-user')


      </div>

        <h1 class="mb-3 text-xl font-bold text-center shadow">Options</h1>

      @include('admin.settings.options.index')

      @include('admin.settings.profile.index')

    </div>
</div>

@include('admin.popups.settings-popup')

@endsection