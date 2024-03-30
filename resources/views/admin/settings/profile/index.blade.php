<h1 class="mt-3 text-center text-xl font-bold shadow">Profile Information</h1>

<form action="{{ route('admin.settings.update-profile', auth()->user()->id) }}" method="post" class="mt-4 p-4 grid grid-cols-3 border border-gray-600 rounded-xl shadow">
  @csrf
  @method('POST')
  <div class="mt-2 w-60">
    <label class="block text-sm font-medium leading-6 text-gray-900">First Name:</label>
    <input name="first_name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ auth()->user()->first_name }}" required>
  </div>

  <div class="mt-2 w-60">
    <label class="block text-sm font-medium leading-6 text-gray-900">Last Name:</label>
    <input name="last_name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ auth()->user()->last_name }}" required>
  </div>

  <div class="mt-2 w-60">
    <label class="block text-sm font-medium leading-6 text-gray-900">Email:</label>
    <input name="email" type="email" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ auth()->user()->email }}" required>
  </div>

  <div class="mt-4 col-span-3 text-center">
    <button class="py-0.5 px-2 rounded-md bg-green-600 hover:bg-green-700 text-gray-100" type="submit">Save Changes</button>
  </div>
 
</form>