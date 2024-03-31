<div class="border border-gray-700 bg-gray-50 shadow-xl rounded-lg">
  <div class="grid grid-cols-2 gap-10 px-8 pt-8">

    <div>
      <div class="bg-blue-400 shadow-xl border pt-2 pb-4 border-gray-400 rounded-xl max-w-96 mx-auto">
        <h1 class="text-center text-xl mb-2 font-semibold">Category</h1>

        @if($category->count() > 0)
          @foreach($category as $rs)
          <div class="flex justify-between py-1 px-4 bg-gray-800/20 hover:bg-gray-800/25 border-b border-gray-600">
            <h1>{{ $rs->name }}</h1>
            @include('admin.settings.options.destroy')
          </div>
          @endforeach
        @endif

      </div>
    </div>

    <div>
      <div class="bg-blue-400 shadow-xl border pt-2 pb-4 border-gray-400 rounded-xl max-w-96 mx-auto">
        <h1 class="text-center text-xl mb-2xl font-semibold">Center</h1>


        @if($center->count() > 0)
          @foreach($center as $rs)
          <div class="flex justify-between py-1 px-4 bg-gray-800/20 hover:bg-gray-800/25 border-b border-gray-600">
            <h1>{{ $rs->name }}</h1>
            @include('admin.settings.options.destroy')
          </div>
          @endforeach
        @endif

      </div>
    </div>

    <div>
      <div class="bg-blue-400 shadow-xl border pt-2 pb-4 border-gray-400 rounded-xl max-w-96 mx-auto">
        <h1 class="text-center text-xl mb-2 font-semibold">Position</h1>

        @if($position->count() > 0)
          @foreach($position as $rs)
          <div class="flex justify-between py-1 px-4 bg-gray-800/20 hover:bg-gray-800/25 border-b border-gray-600">
            <h1>{{ $rs->name }}</h1>
            @include('admin.settings.options.destroy')
          </div>
          @endforeach
        @endif

      </div>
    </div>

    <div>
      <div class="bg-blue-400 shadow-xl border pt-2 pb-4 border-gray-400 rounded-xl max-w-96 mx-auto">
        <h1 class="text-center text-xl mb-2 font-semibold">Department</h1>

        @if($department->count() > 0)
          @foreach($department as $rs)
          <div class="flex justify-between py-1 px-4 bg-gray-800/20 hover:bg-gray-800/25 border-b border-gray-600">
            <h1>{{ $rs->name }}</h1>
            @include('admin.settings.options.destroy')
          </div>
          @endforeach
        @endif

      </div>
    </div>


    @include('admin.settings.options.create')

  </div>
</div>