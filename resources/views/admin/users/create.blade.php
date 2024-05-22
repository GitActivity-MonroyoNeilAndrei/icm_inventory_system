<button id="openCreateButton" class="bg-blue-600 hover:bg-blue-500 px-5 py-1 rounded text-slate-200 shadow">
  Add User
</button>


<div id="create-background" class="fixed top-0 left-0 z-20 w-screen h-screen bg-gray-700/50 hidden"></div>

<div id="myCreate" class="fixed z-30 inset-x-0 top-10 hidden">
  <form action="{{ route('user.store' ) }}" method="POST" class="flex flex-col justify-center items-center bg-white mx-auto w-80 rounded-lg shadow-xl pt-4 pb-1 px-8 border border-gray-700">
    @csrf

    <h1 class="text-2xl font-semibold leading-none">Add User</h1>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">First Name:</label>
      <input name="first_name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Last Name:</label>
      <input name="last_name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Email:</label>
      <input name="email" type="email" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Position:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="position" required>
        @foreach($position as $rs)
          @if($rs->status == 'enable')
            <option value="{{ $rs->name }}">{{ $rs->name }}</option>
          @endif
        @endforeach
      </select>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Department:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="department" required>
        @foreach($department as $rs)
          @if($rs->status == 'enable')
            <option value="{{ $rs->name }}">{{ $rs->name }}</option>
          @endif
        @endforeach
      </select>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Role:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="role" required>
        <option value="admin">admin</option>
        <option value="operational head">operational head</option>
      </select>
    </div>

    <div class="mt-2 w-full">
      <label class="block text-sm font-medium leading-6 text-gray-900">Campus:</label>
      <select id="small" class="block w-full px-2 py-2 shadow text-sm border border-gray-600 rounded hover:ring-gray-600 hover:ring-1 focus:ring-indigo-700 focus:ring-offset-2" name="campus" required>
        @foreach($campus as $rs)
          @if($rs->status == 'enable')
            <option value="{{ $rs->name }}">{{ $rs->name }}</option>
          @endif
        @endforeach
      </select>
    </div>

    <div class="py-5 flex gap-4">
      <button type="button" id="closeCreate" class="px-3 py-1 bg-red-700 rounded  text-slate-200">Cancel</button>
      <input type="submit" class="px-3 py-1 bg-blue-700 rounded text-slate-200 cursor-pointer" value="Add">
    </div>

  </form>
</div>

<script defer>
    document.getElementById('openCreateButton').addEventListener('click', function() {
        document.getElementById('myCreate').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        document.getElementById('create-background').classList.remove('hidden');
    });

    document.getElementById('closeCreate').addEventListener('click', function() {
        document.getElementById('myCreate').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        document.getElementById('create-background').classList.add('hidden');
    });

</script>
