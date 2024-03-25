@extends('user.layouts.user_layout')
 
@section('body')


<div id="modal-background" class="fixed top-0 left-0 z-20 w-full h-full bg-gray-700/80">

</div>

<div id="myModal" class="fixed z-30 inset-x-0 top-10">
    <form action="{{ route('user.item.update', $item->id) }}" method="post" class="flex items-center justify-center">
      @csrf
      @method('PUT')
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 overflow-y-auto" style="max-height: 85vh;">

            <h1 class="font-bold text-2xl text-center text-neutral-800">Edit User</h1>


            <div class="mt-2 w-full">
                <label class="block text-sm font-medium leading-6 text-gray-900">Item ID:</label>
                <input name="item_id" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->item_id }}" required>
            </div>


            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">Name:</label>
              <input name="name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->name }}" required>
            </div>

            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">Category:</label>
              <input name="category" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->category }}" required>
            </div>

            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">Serial No:</label>
              <input name="serial_no" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->serial_no }}" required>
            </div>

            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">Model:</label>
              <input name="model" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->model }}" required>
            </div>

            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">Description:</label>
              <input name="description" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->description }}" required>
            </div>

            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">Additional Details:</label>
              <textarea name="additional_details" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" rows="4" required>{{ $item->additional_details }}</textarea>
            </div>

            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">Status:</label>
              <input name="status" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->status }}" required>
            </div>

            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">Date of Acquisition:</label>
              <input name="date_acquisition" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->date_acquisition }}" required>
            </div>

            <div class="mt-2 w-full">
              <label class="block text-sm font-medium leading-6 text-gray-900">CSV File:</label>
              <input name="csv_file" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ $item->csv_file }}" required>
            </div>





            <div class="py-5 flex justify-center gap-4">
                <a class="px-3 py-1 bg-red-700 rounded  text-slate-200" href="{{ route('user.item.index') }}">Cancel</a>
                <input type="submit" class="px-3 py-1 bg-blue-700 rounded text-slate-200 cursor-pointer" value="Save">
            </div>
        </div>
    </form>
</div>




@endsection