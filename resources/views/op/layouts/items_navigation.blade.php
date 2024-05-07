<div class="pl-1 mb-2 flex items-center">
  <img src="{{ asset('images/home-logo-black.png')  }}" class="size-5 me-2" alt=""> <span class="text-lg font-semibold">Home > Items </span>
</div>
<h1 class="text-2xl font-bold mb-3">All Items</h1>

<div class="flex justify-between border-b">
  <div>
    @include('op.items.create')
    <a href="{{ route('item.scan') }}" class="bg-indigo-700 hover:bg-indigo-600 px-5 py-1 mb-3 rounded text-slate-200 shadow">Scan</a>
  </div>

  <div class="flex justify-center gap-4 text-md text-gray-100 px-3 rounded-sm bg-violet-800 w-fit m-auto">
    <a class="hover:underline hover:underline-offset-2 {{ Route::is('op.item.index') ? 'underline underline-offset-2 font-semibold' : '' }}" href="{{ route('op.item.index') }}">available</a>

    <a class="hover:underline hover:underline-offset-2 {{ Route::is('op.item.indexUnavailable') ? 'underline underline-offset-2 font-semibold' : '' }}" href="{{ route('op.item.indexUnavailable') }}">unavailable</a>
  </div>

  @include('admin.items.import-excel')
</div>
<div class="flex justify-end mt-1">
  @include('admin.items.search-item')
</div>
