@extends('layouts.header')
 
@section('body')


<div id="modal-background" class="fixed top-0 left-0 z-20 w-full h-full bg-gray-700/80">

</div>

<div id="myModal" class="fixed z-30 inset-x-0 top-20 overflow-y-auto">
    <form action="{{ route('user.update', $user->id) }}" method="post" class="flex items-center justify-center">
      @csrf
      @method('PUT')
        <div class="bg-white p-6 rounded-lg shadow-lg w-80">

            <h1 class="font-bold text-2xl text-center text-neutral-800">Edit User</h1>

            <div class="mt-2 w-full">
                <label class="block text-sm font-medium leading-6 text-gray-900">Name:</label>
                <input name="name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $user->name }}" required>
            </div>

            <div class="mt-2 w-full">
                <label class="block text-sm font-medium leading-6 text-gray-900">Email:</label>
                <input name="email" type="email" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $user->email }}" required>
            </div>

            <div class="mt-2 w-full">
            <label class="block text-sm font-medium leading-6 text-gray-900">Position:</label>
            <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="position" required>
                @foreach($position_option as $key => $value)
                    <option value="{{ $key }}" {{ $key == $user->position ? 'selected' : '' }} > {{ $value }} </option>
                @endforeach
            </select>
            </div>

            <div class="mt-2 w-full">
            <label class="block text-sm font-medium leading-6 text-gray-900">Department:</label>
            <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="department" required>
                @foreach($department_option as $key => $value)
                    <option value="{{ $key }}" {{ $key == $user->department ? 'selected' : '' }} > {{ $value }} </option>
                @endforeach
            </select>
            </div>

            <div class="mt-2 w-full">
            <label class="block text-sm font-medium leading-6 text-gray-900">Role:</label>
            <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="role" required>
                @foreach($role_option as $key => $value)
                    <option value="{{ $key }}" {{ $key == $user->role ? 'selected' : '' }} > {{ $value }} </option>
                @endforeach
            </select>
            </div>

            <div class="mt-2 w-full">
            <label class="block text-sm font-medium leading-6 text-gray-900">Center:</label>
            <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="center" required>
                @foreach($center_option as $key => $value)
                    <option value="{{ $key }}" {{ $key == $user->center ? 'selected' : '' }} > {{ $value }} </option>
                @endforeach
            </select>
            </div>

            <div class="py-5 flex justify-center gap-4">
                <a class="px-3 py-1 bg-red-700 rounded  text-slate-200" href="{{ route('user.index') }}">Cancel</a>
                <input type="submit" class="px-3 py-1 bg-blue-700 rounded text-slate-200 cursor-pointer" value="Save">
            </div>
        </div>
    </form>
</div>




@endsection